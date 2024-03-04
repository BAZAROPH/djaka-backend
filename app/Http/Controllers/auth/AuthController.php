<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\OTPServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\VerifyOTPrequest;
use App\Notifications\SendOTPNotification;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateUserRegiteredRequest;
use App\Models\MedicalInformations;
use App\Notifications\ForgetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;

class AuthController extends Controller
{
    //
    public function register(UserStoreRequest $request){
        $data = $request->all();
        $validated = $request->validated();

        $role = Roles::where('label', 'Lambda')->firstOrFail();

        $validated['role'] = $role->id;
        $validated['public_id'] = Str::random(10);
        $validated['phone_number'] = str_replace(' ', '', $validated['phone_number']);
        $validated['birth_date'] = Carbon::parse($validated['birth_date'])->toDateString();

        $user = User::create($validated);


        $medical_information = new MedicalInformations();

        $medical_information->user = $user->id;
        $medical_information->public_id = Str::random(10);
        $medical_information->size = $data['size'] ?? null;
        $medical_information->blood_type = $data['blood_type'] ?? null;
        $medical_information->weight = $data['weight'] ?? null;
        $medical_information->health_problems = json_encode($data['health_problems']) ?? null;

        $medical_information->save();

        event(new Registered($user));

        return response()->json($user, 200);
    }

    public function updateRegisteredUser(UpdateUserRegiteredRequest $request){
        $validated = $request->validated();

        $user = User::find($validated['user']);

        $user->update($validated);
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        return response()->json($user, 200);
    }

    public function login(UserLoginRequest $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            /** @var \App\Models\User $user **/
            $token = $user->createToken('mobileAuthToken')->plainTextToken;

            $data = [
                'token' => $token,
                'user' => $user,
            ];

            return response()->json($data, 200);
        }

        return response()->json(['message' => 'Email ou mot de passe incorrecte'], 401);
    }

    public function logout(){

        $user = Auth::user();

        /** @var \App\Models\User $user **/
        $user->tokens()->delete();

        $data = [
            'success' => true,
            'message' => 'Successfully logged out'
        ];

        return response()->json($data, 200);
    }

    public function verifyOTP(VerifyOTPrequest $request){
        $validated = $request->validated();
        $user = User::where('id',  $validated['user'])->firstOrFail();

        if($user->otp == $validated['otp']){
            if ($user->otp_expiration >= now()) {

                $user->otp = null;
                $user->otp_expiration = null;
                $user->phone_number_verified_at = now();
                $user->save();


                $data = [
                    'error' => false,
                    'message' => 'Code OTP est valide'
                ];

                return response()->json($data, 200);

            }else {

                $data = [
                    'error' => true,
                    'message' => 'Votre code OTP a expiré'
                ];

                return response()->json($data, 401);

            }

        }else {

            $data = [
                'error' => true,
                'message' => 'Votre code est invalide'
            ];

            return response()->json($data, 401);
        }
    }

    public function resendOTP(User $user){
        if($user->phone_number_verified_at !==null){
            $user->notify(new ForgetPasswordNotification());
        }else{
            $user->notify(new SendOTPNotification);
        }

        $data = [
            'error' => false,
            'message' => 'Code envoyé avec succès'
        ];

        return response()->json($data, 200);

    }

    public function forgetPassword(ForgetPasswordRequest $request){
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->firstOrFail();

        $user->notify(new ForgetPasswordNotification());

        return response()->json($user, 200);
    }

    public function resetPassword(ResetPasswordRequest $request){
        $validated = $request->validated();

        $user = User::where('id', $validated['user'])->firstOrFail();
        $user->update([
            'password' => Hash::make($validated['password']),
            'reset_password_at' => now(),
        ]);

        return response()->json([
            'error' => false,
            'message' => 'Mot de passe modifié avec succès'
        ], 200);
    }
}

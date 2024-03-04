<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MedicalInformations;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MedicalInformationStoreRequest;
use App\Http\Requests\MedicalInformationUpdateRequest;

class MedicalInformationController extends Controller
{
    //
     //
    // public function index(){
    //     $medical_informations = MedicalInformations::all();

    //     return response()->json($medical_informations, 200);
    // }

    public function get(){
        $medical_information = MedicalInformations::where('user', Auth::user()->id)->firstOrFail();

        return response()->json($medical_information, 200);
    }

    public function store(MedicalInformationStoreRequest $request){
        $validated = $request->validated();

        $validated['user'] = Auth::user()->id;
        $validated['public_id'] = Str::random(10);

        MedicalInformations::create($validated);

        return response()->json($validated, 200);
    }

    public function update(Request $request){
        $data = $request->all();

        $user = User::where('id', $data['user'])->first();
        if(isset($data['nationality']) || isset($data['country']) || isset($data['city']) || isset($data['district']) || isset($data['town'])){
            $validated = [
                'nationality' => $data['nationality'],
                'country' => $data['country'],
                'city' => $data['city'],
                'district' => $data['district'],
                'town' => $data['town'],
            ];

            $user->update($validated);
        }

        if($request->hasFile('image')){
            $user->clearMediaCollection('profile');
            $user->addMediaFromRequest('image')->toMediaCollection('profile');
        }


        $medical_information = MedicalInformations::where('user', $user->id)->firstOrFail();
        $medical_information->update($data);

        return response()->json($medical_information, 200);
    }
}

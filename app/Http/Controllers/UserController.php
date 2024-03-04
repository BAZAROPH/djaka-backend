<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index(){

        $users = User::all();

        return response()->json($users, 200);
    }

    public function consulation($public_id){

        $user = User::where('public_id', $public_id)->firstOrFail();
        $user->birth_date = Carbon::parse($user->birth_date)->age;

        $medical_informations = $user->MedicalInformations;
        $medical_informations->allergies = json_decode($medical_informations->allergies);
        $medical_informations->health_problems = json_decode($medical_informations->health_problems);
        $medical_informations->medications = json_decode($medical_informations->medications);
        $medical_informations->diseases = json_decode($medical_informations->diseases);
        $medical_informations->vaccines = json_decode($medical_informations->vaccines);
        $medical_informations->referring_doctor = json_decode($medical_informations->referring_doctor);
        $medical_informations->referring_doctor_contact = json_decode($medical_informations->referring_doctor_contact);
        $medical_informations->emergency_contacts = json_decode($medical_informations->emergency_contacts);
        $medical_informations->insurance = json_decode($medical_informations->insurance);

        return view('consultation.consultation', [
            'user' => $user,
            'medical_informations' => $medical_informations
        ]);
    }

}

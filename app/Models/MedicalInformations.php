<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalInformations extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'public_id',
        'user',
        'blood_type',
        'size',
        'weight',
        'health_problems',
        'medications',
        'diseases',
        'insurance',
        'display',
        'updated_at',
        'created_at',
        'allergies',
        'vaccines',
        'referring_doctor',
        'referring_doctor_contact',
        'emergency_contacts',

    ];

    public function User(){
        return $this->hasOne(User::class, 'user');
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'public_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'area_code',
        'gender',
        'nationality',
        'birth_date',
        'district',
        'otp',
        'otp_expiration',
        'phone_number_verified_at',
        'role',
        'country',
        'city',
        'town',
        'password',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'otp',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function routeNotificationForVonage(){
        return $this->phone_number;
    }

    public function Role(){
        return $this->belongsTo(Roles::class, 'role');
    }

    public function Country(){
        return $this->belongsTo(Countries::class, 'country');
    }

    public function City(){
        return $this->belongsTo(Cities::class, 'city');
    }

    public function Town(){
        return $this->belongsTo(Towns::class, 'town');
    }

    public function MedicalInformations(){
        return $this->hasOne(MedicalInformations::class, 'user');
    }
}

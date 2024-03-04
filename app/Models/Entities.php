<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entities extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'public_id',
        'first_name',
        'last_name',
        'contact',
        'email',
        'type',
        'updated_at',
        'created_at',
    ];

    public function Type(){
        return $this->belongsTo(EntityTypes::class, 'type');
    }
}

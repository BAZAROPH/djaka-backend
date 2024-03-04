<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntityTypes extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'public_id',
        'label',
        'updated_at',
        'created_at',
    ];

    public function Entities(){
        return $this->hasMany(Entities::class, 'type');
    }
}

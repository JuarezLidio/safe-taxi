<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $dates = [
        'deleted_at'
    ];

    protected $fillable = [
        'full_name',
        'surnames',
        'is_actived',
        'photo',
    ];

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'id_driver');
    }
}

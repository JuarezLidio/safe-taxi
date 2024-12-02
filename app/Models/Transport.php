<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transport extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $fillable = [
        'model',
        'sub_model',
        'car_plate',
        'brand',
        'sub_brand',
        'economic_number',	
        'is_actived',
    ];

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'id_transport');
    }
}

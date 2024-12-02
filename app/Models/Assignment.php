<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $fillable = [
        'id_driver',
        'id_transport',
        'is_actived'
    ];

    public function drivers(){
        return $this->belongsTo(Driver::class, 'id_driver');
    }

    public function transports(){
        return $this->belongsTo(Transport::class, 'id_transport');
    }
}

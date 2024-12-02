<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmergencyContact extends Model
{
    use HasFactory;
    use SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'alias',
        'description',
        'email',
        'phone',
        'is_active',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}

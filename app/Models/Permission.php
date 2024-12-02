<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $fillable = [
        'id_parent',
        'alias',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permission_self()
    {
        return $this->belongsTo(Permission::class, 'id_parent');
    }
}

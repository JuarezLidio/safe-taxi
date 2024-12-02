<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'name',
    ];
}

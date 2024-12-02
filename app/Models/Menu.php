<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $fillable = [
        'id_parent',
        'name',
        'destination_url',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function menu_self()
    {
        return $this->belongsTo(Menu::class, 'id_parent');
    }

}

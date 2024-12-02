<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Find root role
        $rootRole = Role::find(1);

        //Get all permissions
        $menus = Menu::all();

        //Assign all permissions to the root role
        $rootRole->menus()->attach($menus->pluck('id'));
    }
}

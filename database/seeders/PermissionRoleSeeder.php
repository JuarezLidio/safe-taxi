<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Find root role
        $rootRole = Role::find(1);

        //Get all permissions
        $permissions = Permission::all();

        //Assign all permissions to the root role
        $rootRole->permissions()->attach($permissions->pluck('id'));
    }
}

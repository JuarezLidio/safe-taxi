<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultPermissions = ['roles', 'permissions', 'menus','drivers','transports','assignments', 'users', 'emergency_contacts'];
        $defaultSubpermissions = ['index','create','store', 'show', 'edit', 'update', 'destroy', 'trash', 'restore', 'drop', 'restoreAll', 'dropAll'];

        //Principal permission
        Permission::create(['alias' => 'controller','id_parent'=> 1]);

        Permission::create(['alias' => 'dashboard','id_parent'=> 1]);

        foreach($defaultPermissions as $permission){

            //Root permission
            Permission::create(['alias' => $permission,'id_parent'=> 1]);

            //Find the last permission
            $lastPermission = Permission::count();

            foreach($defaultSubpermissions as $subpermission){

                Permission::create(['alias' => $subpermission,'id_parent'=> $lastPermission]);

            }
        }

        Permission::create(['alias' => 'indexRelationship','id_parent'=> 3]);
        Permission::create(['alias' => 'editRelationship','id_parent'=> 3]);
        Permission::create(['alias' => 'updateRelationship','id_parent'=> 3]);
    }
}

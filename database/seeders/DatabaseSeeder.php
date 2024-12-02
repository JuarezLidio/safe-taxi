<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);]
        User::create(['name' => 'root', 'surname' => 'root', 'phone'=>'9831123325', 'email'=>'root@root.com', 'password' => Hash::make('root'), 'id_role' => 1, 'is_active'=>1]);

        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(MenuRoleSeeder::class);

    }
}

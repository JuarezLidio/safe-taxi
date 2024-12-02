<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create(['name' => 'index','id_parent'=> 1]);
        Menu::create(['name' => 'Dashboard','id_parent'=> 1, 'destination_url'=>'dashboard']);

    }
}

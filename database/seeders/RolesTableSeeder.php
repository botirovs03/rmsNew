<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Insert two records
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);
    }
}

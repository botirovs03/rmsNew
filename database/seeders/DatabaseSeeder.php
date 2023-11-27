<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\FinancialTransaction;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Manager']);
        Role::create(['name' => 'Employee']);

        // Seed users
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role_id' => 1, // Assuming Admin role has id 1
            'gender' => 'Male',
            'phone'=> '+998999216853',
            'address' => 'Y. Tunusov, Tashkent'
        ]);

        User::factory()->create([
            'name' => 'Admin User1',
            'email' => 'admin1@example.com',
            'gender' => 'Male',
            'phone'=> '+998999216853',
            'address' => 'Y. Tunusov, Tashkent',
            'role_id' => 2, // Assuming Manager role has id 2
        ]);

        User::factory()->create([
            'name' => 'Admin User2',
            'email' => 'admin2@example.com', 
            'gender' => 'Male',
            'phone'=> '+998999216853',
            'address' => 'Y. Tunusov, Tashkent',
            'role_id' => 3, // Assuming Employee role has id 3
        ]);
    }
}

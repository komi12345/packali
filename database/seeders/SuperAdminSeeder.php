<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'superadmin@example.com'], // Condition to find existing user
            [
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'), // Change this to a strong password
            'is_admin' => 1, // Assuming 'is_admin' marks an admin user
            'is_super_admin' => 1 // Add a new field to distinguish super admin
        ]);
    }
}
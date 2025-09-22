<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UpdateUserSeeder extends Seeder
{
    public function run()
    {
        // Create sample users for each role
        $adminRole = Role::where('name', 'Admin')->first();
        $staffRole = Role::where('name', 'Staff')->first();
        $parentsRole = Role::where('name', 'Parents')->first();

        // Create Admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'is_active' => 1,
            ]
        );
        $admin->assignRole($adminRole);

        // Create Staff user
        $staff = User::firstOrCreate(
            ['email' => 'staff@example.com'],
            [
                'name' => 'Staff User',
                'password' => bcrypt('password'),
                'is_active' => 1,
            ]
        );
        $staff->assignRole($staffRole);

        // Create Parents user
        $parent = User::firstOrCreate(
            ['email' => 'parent@example.com'],
            [
                'name' => 'Parent User',
                'password' => bcrypt('password'),
                'is_active' => 1,
            ]
        );
        $parent->assignRole($parentsRole);
    }
}
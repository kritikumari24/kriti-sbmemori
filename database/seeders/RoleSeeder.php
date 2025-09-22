<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all permissions
        $allPermissions = Permission::all();

        $roles = [
            ['name' => 'Admin', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'Staff', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'Parents', 'guard_name' => 'web', 'created_at' => Carbon::now()],
        ];

        if (!Role::count()) {
            foreach ($roles as $value) {
                $role = Role::create($value);

                if ($role->name == 'Admin') {
                    // Attach all permissions to the admin role
                    $role->permissions()->attach($allPermissions);
                    // Sync permissions with the admin role
                    $role->syncPermissions($allPermissions);
                }
            }
        }
    }
}

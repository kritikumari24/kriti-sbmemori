<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = [
            ['name' => 'role-list', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'role-create', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'role-edit', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'role-delete', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'permission-list', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'permission-create', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'permission-edit', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'permission-delete', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'user-list', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'user-create', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'user-edit', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'user-delete', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'staff-list', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'staff-create', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'staff-edit', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'staff-delete', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'product-list', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'product-create', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'product-edit', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'product-delete', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'page_content-list', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'page_content-create', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'page_content-edit', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'page_content-delete', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'faq-list', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'faq-create', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'faq-edit', 'guard_name' => 'web', 'created_at' => Carbon::now()],
            ['name' => 'faq-delete', 'guard_name' => 'web', 'created_at' => Carbon::now()],
        ];

        if (!Permission::count()) {
            foreach ($permission as $value) {
                Permission::create($value);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelHasRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model_has_role = ['role_id' => '1', 'model_type' => 'App\\Models\\User', 'model_id' => '1'];
        
        // Check if the role assignment already exists
        $exists = DB::table('model_has_roles')
            ->where('role_id', $model_has_role['role_id'])
            ->where('model_type', $model_has_role['model_type'])
            ->where('model_id', $model_has_role['model_id'])
            ->exists();
            
        if (!$exists) {
            DB::table('model_has_roles')->insert($model_has_role);
        }
    }
}

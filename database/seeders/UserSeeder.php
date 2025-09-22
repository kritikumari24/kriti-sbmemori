<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    
    {
        $data =  [
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'mobile_no'=>'8078602432',
            'lang'=>'en',
            'is_active'=>'1',
            'password'=> Hash::make('123456'),
            'created_at'=> Carbon::now()
        ];
        User::create($data);
    }
}

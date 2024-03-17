<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
{
    DB::table('users')->insert([
        'name' => 'Administrator',
        'email' => 'aa@aa.aa',
        'email_verified_at' => now(),
        'password' => Hash::make('P@$$w0rd'),
        'is_approved' => true, // Admin should be approved by default
        'is_admin' => true, // Admin should be an admin by default
        'created_at' => now(),
        'updated_at' => now()
    ]);

    
}
}

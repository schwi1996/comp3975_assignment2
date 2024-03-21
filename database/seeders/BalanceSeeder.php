<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('start_balances')->insert([
            'balance' => 4000.00, // Replace this with your hard-coded starting balance
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BucketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('buckets')->insert([
            'vendor' => 'Supers',
            'category' => 'Grocery',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('buckets')->insert([
            'vendor' => 'Tim Hortons',
            'category' => 'Entertainment',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('buckets')->insert([
            'vendor' => 'Costco',
            'category' => 'Grocery',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('buckets')->insert([
            'vendor' => 'Fortis',
            'category' => 'Utility',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('buckets')->insert([
            'vendor' => 'MSP',
            'category' => 'Insurance',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('buckets')->insert([
            'vendor' => 'Restaurant',
            'category' => 'Entertainment',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('buckets')->insert([
            'vendor' => 'Walmart',
            'category' => 'Grocery',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('buckets')->insert([
            'vendor' => 'Rogers',
            'category' => 'Utility',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('buckets')->insert([
            'vendor' => 'Shaw',
            'category' => 'Utility',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('buckets')->insert([
            'vendor' => 'McDonalds',
            'category' => 'Entertainment',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('buckets')->insert([
            'vendor' => 'Safeway',
            'category' => 'Grocery',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('buckets')->insert([
            'vendor' => 'Subway',
            'category' => 'Entertainment',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

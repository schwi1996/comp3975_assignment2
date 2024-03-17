<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Events\MigrationsEnded;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot()
{
    // Listen for the 'migrated' event
    \Illuminate\Support\Facades\Event::listen(MigrationsEnded::class, function ($event) {
        // Check if the users table exists to avoid any errors
        if (Schema::hasTable('users')) {
            // Insert admin user only if there's no user in the table already
            if (DB::table('users')->count() == 0) {
                DB::table('users')->insert([
                    'name' => 'Administrator',
                    'email' => 'aa@aa.aa',
                    'email_verified_at' => now(),
                    'password' => Hash::make('P@$$w0rd'), // Example password
                    'is_approved' => true,
                    'is_admin' => true, // Correct the typo from 'is_adimin' to 'is_admin'
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    });
}
}

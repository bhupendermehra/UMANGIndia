<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            StateSeeder::class,
            SchemeSeeder::class,
            SettingSeeder::class,
            AdminSeeder::class,
            HindiTranslationSeeder::class,
            ExpandedSchemeSeeder::class,
            StateSchemesMaharashtraSeeder::class,
            StateSchemesUttarPradeshSeeder::class,
            StateSchemesBiharSeeder::class,
            StateSchemesWestBengalSeeder::class,
            StateSchemesMadhyaPradeshSeeder::class,
        ]);

        // Ensure admin user exists
        User::updateOrCreate(
            ['email' => 'admin@umangindia.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}

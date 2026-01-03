<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Contact;
use App\Models\SalesTarget;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a default admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Use a consistent password for testing
        ]);

        // Create additional test users
        User::factory(5)->create();

        // Create some companies
        Company::factory(10)->create();

        // Create some contacts linked to existing companies
        Contact::factory(20)->create();

        // Create some sales targets linked to existing users
        SalesTarget::factory(10)->create();
    }
}

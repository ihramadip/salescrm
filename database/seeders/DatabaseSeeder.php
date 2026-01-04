<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Deal;
use App\Models\Lead;
use App\Models\Revenue;
use App\Models\SalesTarget;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create a specific Admin User
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // 2. Create a handful of Sales Users
        $salesUsers = User::factory(4)->create();

        // 3. Create Companies
        $companies = Company::factory(20)->create();

        // 4. Create sequential Sales Targets for each sales user for the last 12 months
        foreach ($salesUsers as $user) {
            for ($i = 0; $i < 12; $i++) {
                $date = Carbon::now()->subMonths($i);
                SalesTarget::factory()->create([
                    'user_id' => $user->id,
                    'month' => $date->month,
                    'year' => $date->year,
                    'target_amount' => rand(20000, 100000),
                ]);
            }
        }

        // 5. Create Leads over the last year, assigned to sales users
        Lead::factory(100)->make()->each(function ($lead) use ($salesUsers, $companies) {
            $lead->assigned_to = $salesUsers->random()->id;
            $lead->created_by = $salesUsers->random()->id;
            $lead->company_id = $companies->random()->id;
            $lead->save();
        });

        // 6. Create Deals over the last year, from existing companies and contacts, assigned to sales users
        Contact::factory(50)->create();

        Deal::factory(80)->make()->each(function ($deal) use ($salesUsers, $companies) {
            $deal->assigned_to = $salesUsers->random()->id;
            $deal->company_id = $companies->random()->id;
            $deal->contact_id = Contact::all()->random()->id;
            $deal->save();

            // 7. For each 'won' deal, create a corresponding revenue record
            if ($deal->stage === 'won') {
                Revenue::factory()->create([
                    'deal_id' => $deal->id,
                    'amount' => $deal->value,
                    'revenue_date' => $deal->updated_at, // Assume revenue date is when deal was marked as won
                ]);
            }
        });
    }
}
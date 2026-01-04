<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Deal;
use App\Models\Lead;
use App\Observers\ContactObserver;
use App\Observers\DealObserver;
use App\Observers\LeadObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Deal::observe(DealObserver::class);
        Lead::observe(LeadObserver::class);
        Contact::observe(ContactObserver::class);
    }
}


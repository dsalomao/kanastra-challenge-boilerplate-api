<?php

namespace App\Providers;

use App\Jobs\ProcessTicket;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\RateLimiter;
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
        // Rate Limit for Mailtraps free account
        RateLimiter::for('emails', function (ProcessTicket $job) {
            return Limit::perSecond(1)->perMinute(50);
        });
    }
}

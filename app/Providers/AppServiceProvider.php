<?php

namespace App\Providers;

use App\Services\CalendarEvent\CalendarEventFetcherService;
use App\Services\CalendarEvent\CalendarEventFetcherServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CalendarEventFetcherServiceInterface::class, CalendarEventFetcherService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

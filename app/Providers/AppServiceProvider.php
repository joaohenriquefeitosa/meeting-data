<?php

namespace App\Providers;

use App\Services\CalendarEvent\CalendarEventFetcherService;
use App\Services\CalendarEvent\CalendarEventFetcherServiceInterface;
use App\Services\ParticipantInformation\ParticipantInformationFetcherService;
use App\Services\ParticipantInformation\ParticipantInformationFetcherServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CalendarEventFetcherServiceInterface::class, CalendarEventFetcherService::class);
        $this->app->bind(ParticipantInformationFetcherServiceInterface::class, ParticipantInformationFetcherService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

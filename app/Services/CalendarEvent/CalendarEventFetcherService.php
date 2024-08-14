<?php

namespace App\Services\CalendarEvent;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CalendarEventFetcherService implements CalendarEventFetcherServiceInterface
{
    /**
     * @var string
     */
    private $endPoint;

    public function __construct() {
        $this->endPoint = config('calendar_endpoints.calendar.base_url') . config('calendar_endpoints.calendar.events');
    }

	/**
     * Get event by page
     *
     * @param int $page
     * @param string $accessToken
     * @return array|null
     */
    public function getEventByPage(int $page, string $accessToken): ?array
	{
		try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->get($this->endPoint, [
                'page' => $page,
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Failed to fetch events from Calendar API', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        } catch (\Exception $e) {
            Log::error('Exception occurred while fetching events', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }

        return null;
	}
}
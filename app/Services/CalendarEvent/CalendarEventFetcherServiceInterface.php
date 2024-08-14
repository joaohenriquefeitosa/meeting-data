<?php

namespace App\Services\CalendarEvent;

interface CalendarEventFetcherServiceInterface
{
	/**
     * Get event by page
     *
     * @param int $page
     * @param string $accessToken
     * @return array|null
     */
    public function getEventByPage(int $page, string $accessToken): ?array;
}

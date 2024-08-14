<?php

namespace App\Services\ParticipantInformation;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ParticipantInformationFetcherService implements ParticipantInformationFetcherServiceInterface
{
    /**
     * The base URL for the participant information API.
     *
     * @var string
     */
    private $baseUrl;

    /**
     * The authorization token for the participant information API.
     *
     * @var string
     */
    private $authToken;

    /**
     * Create a new ParticipantInformationFetcherService instance.
     */
    public function __construct()
    {
        $this->baseUrl = config('calendar_endpoints.participant_info.base_url') . config('calendar_endpoints.calendar.person');
        $this->authToken = config('calendar_endpoints.participant_info.auth_token');
    }

    /**
     * Get participant information by email address.
     *
     * @param string $email
     * @return array|null
     */
    public function getParticipantInformationByEmail(string $email): ?array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->authToken,
            ])->get($this->baseUrl . $email);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Failed to fetch participant information from API', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        } catch (\Exception $e) {
            Log::error('Exception occurred while fetching participant information', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }

        return null;
    }
}
<?php

namespace App\Services\ParticipantInformation;

interface ParticipantInformationFetcherServiceInterface
{
    /**
     * Get participant information by email address.
     *
     * @param string $email
     * @return array|null
     */
    public function getParticipantInformationByEmail(string $email): ?array;
}
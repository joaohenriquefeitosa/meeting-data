<?php

return [
    'calendar' => [
        'base_url' => env('PARTICIPANT_INFO_API_BASE_URL', 'https://app.usergems.com/api/hiring/calendar-challenge'),
        'events' => '/events',
        'person' => '/person/',
        'auth_token' => env('PARTICIPANT_INFO_API_TOKEN', '9d^XItOjTAGSG5ch'),
    ],
];
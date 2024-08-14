<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailPreviewController extends Controller
{
    public function preview()
    {
        $avatar = 'https://placehold.co/100';

        $event = [
            'company_name' => 'Algolia',
            'company_linkedin_url' => 'https://www.linkedin.com/company/algolia/',
            'company_size' => 700,                
            'event_title' => 'UserGems x Algolia',
            'event_duration' => 30,
            'event_start' => '9:30 AM',
            'event_end' => '10:00 AM',
            'join_from_usergems' => [
                [
                    'name' => 'Joss',
                    'status' => 'accepted'
                ]
            ],
            'participants' => [
                [
                    'status' => 'accepted',
                    'avatar' => $avatar,
                    'full_name' => 'Demi Mainar',
                    'title' => 'GTM Chief of Staff',
                    'total_meetings' => 12,
                    'meets' => 'Met with Blaise (5x) & Christian (7x)',
                    'linkedin_url' => 'https://www.linkedin.com/company/algolia/'
                ],
                [
                    'status' => 'accepted',
                    'avatar' => $avatar,
                    'full_name' => 'Josua Mateer',
                    'title' => 'Sr Manager, Marketing Operations and Technology',
                    'total_meetings' => 11,
                    'meets' => 'Met with Blaise (1x) & Christian (1x)',
                    'linkedin_url' => 'https://www.linkedin.com/company/algolia/'
                ],
                [
                    'status' => 'accepted',
                    'avatar' => $avatar,
                    'full_name' => 'Woojin Shin',
                    'title' => 'Manager, North America Business Development',
                    'total_meetings' => 3,
                    'meets' => '',
                    'linkedin_url' => 'https://www.linkedin.com/company/algolia/'
                ],
                [
                    'status' => 'rejected',
                    'avatar' => $avatar,
                    'full_name' => 'Aletta Noujaim',
                    'title' => 'Director of Sales Develpment, EMEA & emergin markets',
                    'total_meetings' => 4,
                    'meets' => 'Met with Christian (1x)',
                    'linkedin_url' => 'https://www.linkedin.com/company/algolia/'
                ]
            ]
        ];
        return view('emails.calendar_event', compact('event'));
    }
}

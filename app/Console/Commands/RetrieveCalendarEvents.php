<?php

namespace App\Console\Commands;

use App\Models\Meeting;
use App\Services\CalendarEvent\CalendarEventFetcherServiceInterface;
use Illuminate\Console\Command;
use App\Models\User;
use App\Services\ParticipantInformation\ParticipantInformationFetcherServiceInterface;
use Carbon\Carbon;

class RetrieveCalendarEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:retrieve-calendar-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve and process calendar events for all users with a valid access token';

    /**
     * @var CalendarEventFetcherServiceInterface
     */
    protected $calendarEventFetcherService;

    /**
     * @var ParticipantInformationFetcherServiceInterface
     */
    protected $participantInformationFetcherService;

    /**
     * Create a new command instance.
     *
     * @param CalendarEventFetcherServiceInterface $calendarEventFetcherService
     */
    public function __construct(
        CalendarEventFetcherServiceInterface $calendarEventFetcherService,
        ParticipantInformationFetcherServiceInterface $participantInformationFetcherService)
    {
        parent::__construct();
        $this->calendarEventFetcherService = $calendarEventFetcherService;
        $this->participantInformationFetcherService = $participantInformationFetcherService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::whereNotNull('access_token')->get();

        foreach ($users as $user) {
            $this->info("Processing events for user: {$user->email}");

            $allEvents = [];
            $page = 1;
            $continuePaging = true;
            $lastUpdate = null;


            while ($continuePaging) {
                $eventsPage = $this->calendarEventFetcherService->getEventByPage($page, $user->access_token);

                if (is_null($eventsPage) || empty($eventsPage['data'])) {
                    $this->error("No events returned or API call failed for user: {$user->email}");
                    break;
                }

                // Capture the 'changed' value from the first event on the first page
                if ($page === 1) {
                    $lastUpdate = $eventsPage['data'][0]['changed'];
                }

                // Checks if the last_event_attended field is empty (first time the user is going through the process)
                // or if the user has attended any event since the last update
                if (empty($user->last_event_attended)) {
                    $allEvents = array_merge($allEvents, $eventsPage['data']);
                } else {
                    foreach ($eventsPage['data'] as $event) {
                        if ($event['changed'] <= $user->last_event_attended) {
                            $continuePaging = false;
                            break;
                        }
                        $allEvents[] = $event;
                    }
                }

                // If there are fewer events than per_page, we've reached the last page
                if (count($eventsPage['data']) < $eventsPage['per_page']) {
                    $continuePaging = false;
                }

                $page++;
            }

            // Filter and ordenate events for today
            $todayEvents = array_filter($allEvents, function($event) {
                $eventStart = Carbon::parse($event['start']);
                return $eventStart->isToday();
            });
            usort($todayEvents, function($a, $b) {
                return Carbon::parse($a['start'])->timestamp - Carbon::parse($b['start'])->timestamp;
            });

            // Process the filtered and sorted events
            $this->processEvents($todayEvents, $user);

            // Update the last_event_attended field with the 'changed' value from the first event on the first page
            if ($lastUpdate) {
                $user->last_event_attended = $lastUpdate;
                $user->save();
            }

            $this->info("Finished processing events for user: {$user->email}");
        }
    }

    /**
     * Process the retrieved events.
     *
     * @param array $events
     * @param User $user
     */
    protected function processEvents(array $events, User $user)
    {
        foreach ($events as $event) {
            $externalEmails = [];
            $internalEmails = [];

            if (!empty($event['accepted'])) {
                foreach ($event['accepted'] as $email) {
                    if (!$this->isUserGemsEmail($email)) {
                        $externalEmails[] = [
                            'information' => [],
                            'email' => $email,
                            'status' => 'accepted'
                        ];
                    }

                    if ($this->isUserGemsEmail($email) && $email !== $user->email) {
                        $internalEmails[] = [
                            'email' => $email,
                            'status' => 'accepted'
                        ];
                    }
                }
            }

            if (!empty($event['rejected'])) {
                foreach ($event['rejected'] as $email) {
                    if (!$this->isUserGemsEmail($email)) {
                        $externalEmails[] = [
                            'information' => [],
                            'email' => $email,
                            'status' => 'rejected'
                        ];
                    }

                    if ($this->isUserGemsEmail($email) && $email !== $user->email) {
                        $internalEmails[] = [
                            'email' => $email,
                            'status' => 'rejected'
                        ];
                    }
                }
            }

            foreach ($externalEmails as &$externalEmail) {
                $externalEmail['information'] = $this->participantInformationFetcherService->getParticipantInformationByEmail($externalEmail['email']);
            }

            $participants = [];

            foreach($externalEmails as $externalEmail) {
                $totalMeetings = Meeting::where('participant_id', $externalEmail['information']['id'])
                    ->select(User::raw('count(*) as total_meetings'))
                    ->get();

                $meets = 'Met with';
                $meetings = Meeting::where('participant_id', $externalEmail['information']['id'])
                    ->select('user_id', User::raw('count(*) as total_meetings'))
                    ->groupBy('user_id')
                    ->with('user')
                    ->get();
                
                $meetingDetails = [];
                
                foreach ($meetings as $meeting) {
                    $meetingDetails[] = "{$meeting->user->name} ({$meeting->total_meetings}x)";
                }
                
                if (!empty($meetingDetails)) {
                    $meets .= ' ' . implode(' & ', $meetingDetails);
                }
                

                $participants[] = [
                    'email' => $externalEmail['email'],
                    'status' => $externalEmail['status'],
                    'information' => $externalEmail['information'],
                    'full_name' => $externalEmail['information']['first_name'] . ' ' . $externalEmail['information']['first_name'],
                    'title' => $externalEmail['information']['title'],
                    'total_meetings' => $totalMeetings[0]['total_meetings'],
                    'meets' => $meets,
                    'linkedin_url' => $externalEmail['information']['linkedin_url']
                ];
            }

            $eventStart = Carbon::parse($event['start']);
            $eventEnd = Carbon::parse($event['end']);
            $durationInMinutes = $eventStart->diffInMinutes($eventEnd);

            $event = [
                'company_name' => $externalEmails[0]['information']['company']['name'],
                'company_linkedin_url' => $externalEmails[0]['information']['company']['linkedin_url'],
                'company_size' => $externalEmails[0]['information']['company']['employees'],                
                'event_title' => $event['title'],
                'event_durantion' => $durationInMinutes,
                'event_start' => Carbon::parse($event['start'])->format('g:i a'),
                'event_end' => Carbon::parse($event['end'])->format('g:i a'),
                'join_from_usergems' => $internalEmails,
                'participants' => $participants
            ];
        }
    }

    /**
     * Check if an email belongs to the 'usergems.com' domain.
     *
     * @param string $email
     * @return bool
     */
    protected function isUserGemsEmail(string $email): bool
    {
        return strpos($email, '@usergems.com') !== false;
    }
}

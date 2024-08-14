<!DOCTYPE html>
<html>
<head>
    <title>Upcoming Meeting Details</title>
</head>
<body>
    <h1>Meeting Details</h1>

    <h2>{{ $event['event_title'] }}</h2>
    <p><strong>Company:</strong> <a href="{{ $event['company_linkedin_url'] }}">{{ $event['company_name'] }}</a></p>
    <p><strong>Company Size:</strong> {{ $event['company_size'] }} employees</p>
    <p><strong>Start Time:</strong> {{ $event['event_start'] }}</p>
    <p><strong>End Time:</strong> {{ $event['event_end'] }}</p>
    <p><strong>Duration:</strong> {{ $event['event_durantion'] }} minutes</p>

    <h3>Participants:</h3>
    <ul>
        @foreach($event['participants'] as $participant)
            <li>
                {{ $participant['full_name'] }} ({{ $participant['title'] }})
                - <a href="{{ $participant['linkedin_url'] }}">LinkedIn</a>
                <br>
                Met with: {{ $participant['meets'] }}
            </li>
        @endforeach
    </ul>

    <h3>Internal Attendees:</h3>
    <ul>
        @foreach($event['join_from_usergems'] as $internal)
            <li>{{ $internal['email'] }} ({{ $internal['status'] }})</li>
        @endforeach
    </ul>
</body>
</html>

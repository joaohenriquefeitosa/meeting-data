@include('emails.partials.head')

<body
    style="font-family: Helvetica, sans-serif; -webkit-font-smoothing: antialiased; font-size: 16px; line-height: 1.3; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #f4f5f6; margin: 0; padding: 0;">

    @include('emails.partials.header')

    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body"
        style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f4f5f6; width: 100%;"
        width="100%" bgcolor="#f4f5f6">
        <tr>
            <td style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top;" valign="top">&nbsp;
            </td>
            <td class="container"
                style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; max-width: 600px; padding: 0; padding-top: 24px; width: 600px; margin: 0 auto;"
                width="600" valign="top">
                <div class="content"
                    style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 600px; padding: 0;">

                    <!-- START CENTERED WHITE CONTAINER -->
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="main"
                        style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border: 1px solid #eaebed; border-radius: 16px; width: 100%;"
                        width="100%">

                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class="wrapper"
                                style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; box-sizing: border-box; padding: 24px;"
                                valign="top">
                                <p
                                    style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px; color: #74797f;">
                                    <span style=" font-size: 20px; font-weight: bolder; color:#2bc8bd;">{{
                                        $event['event_start']
                                        }}</span>
                                    <span style="font-size: 18px; font-weight: bolder;"> - {{
                                        $event['event_end'] }}</span> |
                                    <span
                                        style="font-size: 18px; font-weight: bolder; text-decoration: underline;">{{$event['event_title']
                                        }}</span>
                                    <span style="width: 20px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="15"
                                            height="15">
                                            <path
                                                d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                                        </svg>
                                    </span>
                                    ({{ $event['event_duration'] }} min)
                                </p>
                                <p
                                    style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px; color: #74797f;">
                                    Joining from UserGems:
                                    @foreach($event['join_from_usergems'] as $internal)
                                    <span style="font-size: 16px; font-weight: bolder;">
                                        {{ $internal['name'] }}
                                        @if($internal['status'] == 'accepted')
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="15"
                                            height="15">
                                            <path
                                                d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                                        </svg>
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="15"
                                            height="15">
                                            <path
                                                d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
                                        </svg>
                                        @endif
                                    </span>

                                    @endforeach
                                </p>

                                <p
                                    style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px; color: #74797f;">
                                    <a href="{{ $event['company_linkedin_url'] }}">
                                        <span style="font-size: 20px; font-weight: bolder;">{{ $event['company_name']
                                            }}</span>
                                    </a>

                                    <span>
                                        <a href="{{ $event['company_linkedin_url'] }}" style="text-decoration: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="22px"
                                                height="22px">
                                                <path
                                                    d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z" />
                                            </svg>
                                        </a>
                                    </span>

                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="22px"
                                            height="22px">
                                            <path
                                                d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z" />
                                        </svg>
                                    </span>
                                    {{ $event['company_size'] }}
                                </p>

                                <p>
                                    @foreach($event['participants'] as $participant)

                                <table>
                                    <tr>
                                        <!-- Left side with the image (spanning three rows) -->
                                        <td class="image-cell" rowspan="3">
                                            <img src="{{$participant['avatar']}}" alt="User Image"
                                                style="width: 100%; height: auto;">
                                        </td>
                                        <!-- Right side with user data (row 1) -->
                                        <td class="user-data-cell">
                                            <span style=" font-size: 20px; font-weight: bolder; color:#2bc8bd;">
                                                {{$participant['full_name']}}
                                            </span>
                                            @if($internal['status'] == 'accepted')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="15"
                                                height="15">
                                                <path
                                                    d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                                            </svg>
                                            @else
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="15"
                                                height="15">
                                                <path
                                                    d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
                                            </svg>
                                            @endif
                                            <a href="{{ $participant['linkedin_url'] }}" style="text-decoration: none;">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                    width="22px" height="22px">
                                                    <path
                                                        d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <!-- Right side with user data (row 2) -->
                                        <td class="user-data-cell">
                                            <span style="font-size: 18px; font-weight: bolder; color: #74797f;">
                                                {{$participant['title']}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <!-- Right side with user data (row 3) -->
                                        <td class="user-data-cell" style="color: #74797f;">
                                            <span style="font-size: 18px; font-weight: bolder;">
                                                @if($participant['total_meetings'] == '1')
                                                {{ $participant['total_meetings'] }}st
                                                @elif($participant['total_meetings'] == '2')
                                                {{ $participant['total_meetings'] }}nd
                                                @elif($participant['total_meetings'] == '3')
                                                {{ $participant['total_meetings'] }}rd
                                                @else
                                                {{ $participant['total_meetings'] }}th
                                                @endif
                                                Meeting
                                            </span>
                                            @if($participant['meets'] != '')
                                            | {{ $participant['meets'] }}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                                @endforeach
                                </p>
                            </td>
                        </tr>

                        <!-- END MAIN CONTENT AREA -->
                    </table>

                    <!-- START FOOTER -->
                    @include('emails.partials.footer')
                    <!-- END FOOTER -->

                    <!-- END CENTERED WHITE CONTAINER -->
                </div>
            </td>
            <td style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top;" valign="top">&nbsp;
            </td>
        </tr>
    </table>
</body>

</html>
<?php
session_start();
require_once 'google_config.php';

if (!isset($_SESSION['access_token']) || !$_SESSION['access_token']) {
    header('Location: index.php');
    exit;
}

$client = getClient();
$client->setAccessToken($_SESSION['access_token']);

// Check if the access token is valid
if ($client->isAccessTokenExpired()) {
    header('Location: index.php');
    exit;
}

$service = new Google_Service_Calendar($client);

// Create the event
$event = new Google_Service_Calendar_Event([
    'summary' => 'Sample Google Meet Event 2',
    'location' => 'Online',
    'description' => 'This is a Google Meet video conference.',
    'start' => [
        'dateTime' => '2025-03-07T09:00:00-00:00',
        'timeZone' => 'Asia/Kolkata',
    ],
    'end' => [
        'dateTime' => '2025-03-07T10:00:00-00:00',
        'timeZone' => 'Asia/Kolkata',
    ],
    'attendees' => [
        ['email' => 'elements.officialpavan@gmail.com'],
        ['email' => 'pavankumar@elementshrs.com'],
        ['email' => 'web.wahstory@gmail.com']
        
    ],
    'conferenceData' => [
        'createRequest' => [
            'requestId' => 'sample123',
            'conferenceSolutionKey' => ['type' => 'hangoutsMeet']
        ]
    ],
]);

// Insert the event into the user's calendar
$calendarId = 'primary';
$event = $service->events->insert($calendarId, $event, ['conferenceDataVersion' => 1, 'sendUpdates' => 'all']);

// Get the Google Meet link
$hangoutLink = $event->getHangoutLink();
echo "<h3>Your Google Meet Link: </h3>";
echo "<a href='" . $hangoutLink . "'>" . $hangoutLink . "</a>";
?>

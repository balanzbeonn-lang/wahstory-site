<?php
session_start();
require_once 'google_config.php';

$client = getClient();

// Check if the user is already authenticated
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    header('Location: create_event.php');
    exit;
}

// Redirect to Google OAuth authentication if not authenticated
$authUrl = $client->createAuthUrl();
echo "<a href='" . $authUrl . "'>Login with Google to create Google Meet Event</a>";

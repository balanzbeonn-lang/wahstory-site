<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

function getClient() {
    $client = new Google_Client();
    $client->setApplicationName('Google Meet Integration');
    $client->setScopes(Google_Service_Calendar::CALENDAR);
    $client->setAuthConfig(__DIR__ . '/credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Redirect URI should match the one set in Google Developer Console
    $redirectUri = 'https://' . $_SERVER['HTTP_HOST'] . '/googlemeet/callback.php';
    $client->setRedirectUri($redirectUri);
    
    return $client;
}

<?php
require 'vendor/autoload.php';

define('CLIENT_SECRET_PATH', 'client_secret.json');
define('SCOPES', implode(' ', array(
        Google_Service_Calendar::CALENDAR_READONLY)
));

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient() {
    $client = new Google_Client();
    $client->setScopes(SCOPES);
    $client->setAuthConfigFile(CLIENT_SECRET_PATH);
    $client->setRedirectUri('http://localhost:8090/');

    if (!isset($_GET['code']))
    {
        if (!isset($_COOKIE["AccessToken"]))
        {
            $authUrl = $client->createAuthUrl();

            // Redirect the user to get authenticated
            header( "HTTP/1.1 301 Moved Permanently" );
            header( "Location: ".$authUrl );
        }
        else
        {
            $client->setAccessToken($_COOKIE["AccessToken"]);
        }
    }
    else
    {
        $client->authenticate($_GET['code']);
        $access_token = $client->getAccessToken();
        setcookie("AccessToken", $access_token, time()+3600);
    }

    return $client;
}

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

// Get the API client and construct the service object.
$client = getClient();

$service = new Google_Service_Calendar($client);

// Print the user calendars.
$calendarList = $service->calendarList->listCalendarList();

while(true) {
    $pageToken = $calendarList->getNextPageToken();
    if ($pageToken) {
        $optParams = array('pageToken' => $pageToken);
        $calendarList = $service->calendarList->listCalendarList($optParams);
    } else {
        break;
    }
}

include('view.php');
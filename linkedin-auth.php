<?php
require 'vendor/autoload.php';


ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

    include('inc/functions.php');
    $postObj = new Story();

$provider = new \League\OAuth2\Client\Provider\LinkedIn([
    'clientId'     => '7711mahny8lwx5',
    'clientSecret' => 'qN3QB6BgivNmQBdJ',
    'redirectUri'  => 'https://www.wahstory.com/linkedin-auth.php',
    'scopes'       => ['r_liteprofile', 'r_emailaddress'],
    // Update this line
]);

if (!isset($_GET['code'])) {
    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);
    exit;
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    // State is invalid, possible CSRF attack in progress
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
} else {
    try {
        // Try to get an access token using the authorization code grant
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        // We have an access token, which we may use in authenticated
        // requests against the service provider's API.
        // echo 'Access Token: ' . $token->getToken() . "<br>";

        // Using the access token, we may look up details about the resource owner.
        $resourceOwner = $provider->getResourceOwner($token);

        $user = $resourceOwner->toArray();
        
        // var_dump($user);

        // echo 'Hello, ' . $user['localizedFirstName'] . ' ' . $user['email'];
        
    //User Login And Backend Authentication
    $resp = $postObj->UserloginWithSocial($user['email']);
    
    if ($resp['login_status'] == "Success") {
        // Send back success response
        // echo json_encode(['status' => 'success']);
        header("Location: /users/");  
    } else {
        
        
        $Username = $user['localizedFirstName'] . ' ' . $user['localizedLastName'];
        
        $accesstoken = $token->getToken();
        
        $resp2 = $postObj->UsersignupWithLinkedin($Username, $user['email'], 'LinkedIn', $user['id'], $accesstoken);
        
        // var_dump($user);
        
        header("Location: /users/"); 
        
        exit;
          
    }
    
        
    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        // Failed to get the access token or user details.
        exit($e->getMessage());
    }
}
?>

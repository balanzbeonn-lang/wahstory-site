<?php
session_start();

// Include your Facebook SDK initialization code here

if(isset($_SESSION['facebook_access_token'])) {
    // User is already logged in, you can redirect them to their profile page.
    header("Location: /login.steller.php");
    exit();
}

if(isset($_SESSION['facebook_error'])) {
    // Handle any errors here
    echo "Facebook Login Error: " . $_SESSION['facebook_error'];
    unset($_SESSION['facebook_error']);
}

// Check if the Facebook login callback contains the necessary data
if(isset($_GET['code'])) {
    // The callback contains an authorization code, so proceed to exchange it for an access token
    $code = $_GET['code'];

    // Use the authorization code to request an access token from Facebook
    $token_url = "https://graph.facebook.com/v17.0/oauth/access_token?"
                 . "client_id=668250491491323"
                 . "&client_secret=910d69a4625bd09aa9125007bba5564a"
                 . "&redirect_uri=https://www.wahstory.com/inc/fblogin/fbcallback.php"
                 . "&code=" . $code;

    $response = file_get_contents($token_url);
    $params = json_decode($response, true);

    if(isset($params['access_token'])) {
        // Access token successfully obtained, store it in the session
        $_SESSION['facebook_access_token'] = $params['access_token'];

        // Redirect to the user's profile page or dashboard
        header("Location: /single.dashboard.php");
        exit();
    } else {
        // Handle the case where access token retrieval failed
        $_SESSION['facebook_error'] = "Error getting access token.";
        header("Location: /login.steller.php");
        exit();
    }
} else {
    // Handle the case where no authorization code is present in the callback
    $_SESSION['facebook_error'] = "Authorization code not found.";
    header("Location: /login.steller.php");
    exit();
}
?>

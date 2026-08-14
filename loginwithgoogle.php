<?php
include('inc/functions.php');
$postObj = new Story();

// Handle AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['email']) && !empty($data['email'])) {
        // Attempt to log in the user
        $resp = $postObj->UserloginWithSocial($data['email']);

        // Log response from UserloginWithGoogle for debugging
        error_log('UserloginWithGoogle response: ' . $resp);

        if ($resp['login_status'] == "Success") {
            // Send back success response
            echo json_encode(['status' => 'success']);
        } else {
            // Send back failure response with debug info
            echo json_encode(['status' => 'failure', 'message' => 'Login function failed', 'resp' => $resp]);
        }
    } else {
        echo json_encode(['status' => 'failure', 'message' => 'Email is not set or is empty']);
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Login</title>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script>
        function handleCredentialResponse(response) {
            const responsePayload = decodeJwtResponse(response.credential);
            console.log(responsePayload);

            // Send user data to PHP script using AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Handle response from the server
                    const serverResponse = JSON.parse(xhr.responseText);
                    console.log(serverResponse); // Debugging line
                    if (serverResponse.status === 'success') {
                        // Redirect to user page
                        window.location.href = '/users/';
                    } else {
                        console.error('Login failed:', serverResponse.message, serverResponse.resp);
                    }
                }
            };
            xhr.send(JSON.stringify(responsePayload));
        }

        function decodeJwtResponse(token) {
            const base64Url = token.split('.')[1];
            const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
            const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));

            return JSON.parse(jsonPayload);
        }
    </script>
</head>
<body>
    <h1>Google Login</h1>
    <div id="g_id_onload"
        data-client_id="678125914070-9vkfumkdq8r1jue9imnhlra72mo10fi7.apps.googleusercontent.com"
        data-callback="handleCredentialResponse">
    </div>
    <div class="g_id_signin" data-type="standard"></div>
    <div id="user-info"></div>
</body>
</html>

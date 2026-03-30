<?php
$app_secret = '910d69a4625bd09aa9125007bba5564a'; // Replace with your actual app secret

$signed_request = $_POST['signed_request'];

// Verify the signature of the signed request
list($encoded_sig, $payload) = explode('.', $signed_request, 2);

// Decode the payload
$decoded_payload = base64_decode(strtr($payload, '-_', '+/'));

// Verify the signature
$signature = hash_hmac('sha256', $payload, $app_secret, true);
if (hash_equals($signature, base64_decode($encoded_sig))) {
    // Signature is valid, meaning the request is from Facebook
    $data = json_decode($decoded_payload, true);

    // Perform actions based on the deauthorization event
    // For example, log the event or revoke access for the user

    // Respond with a 200 OK status to acknowledge receipt of the request
    http_response_code(200);
} else {
    // Signature verification failed, do not process the request
    http_response_code(400);
}
?>

<html>
    <head>
        
    </head>
<body>
    
<?php 

ini_set('display_errors', 1);
error_reporting(E_ALL);
  
// Your Client ID and Secret
$clientId = 'x2geeach7oeds6oh';
$clientSecret = 'IOu9lNjd';
 $scope = 'emsi_open';  // Include the scope you have
 
// Step 1: Obtain the OAuth Bearer Token
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://auth.emsicloud.com/connect/token",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => http_build_query([
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'grant_type' => 'client_credentials',
        'scope' => 'emsi_open'
    ]),
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/x-www-form-urlencoded"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

// Check for cURL errors
if ($err) {
    die("cURL Error: " . $err);
}

// Decode the response to get the access token
$data = json_decode($response, true);
if (isset($data['access_token'])) {
    $accessToken = $data['access_token'];
} else {
    die("Error obtaining access token: " . $response);
}

// Step 2: Use the access token to fetch skills
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://emsiservices.com/skills/versions/latest/skills?q=.NET&typeIds=ST1%2CST2&fields=id%2Cname%2Ctype%2CinfoUrl&limit=5",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer $accessToken"
    ],
]);

// Execute the request for skills
$response = curl_exec($curl);
$err = curl_error($curl);
$responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl);

// Check for cURL errors
if ($err) {
    echo "cURL Error: " . $err;
} elseif ($responseCode !== 200) {
    echo "Error: HTTP Status Code $responseCode";
} else {
    // Output the raw response for debugging
    echo "Raw Response: " . htmlspecialchars($response) . "<br>";

    // Decode and process the response
    $data = json_decode($response, true);
     
        foreach ($data['data'] as $skill) {
            echo "ID: " . htmlspecialchars($skill['id']) . "<br>";
            echo "Name: " . htmlspecialchars($skill['name']) . "<br>";
            echo "Type: " . htmlspecialchars($skill['type']["name"]) . "<br>";
            echo "Info URL: <a href='" . htmlspecialchars($skill['infoUrl']) . "'>" . htmlspecialchars($skill['infoUrl']) . "</a><br><br>";
        }
     
} 

?>

</body>
</html>
 
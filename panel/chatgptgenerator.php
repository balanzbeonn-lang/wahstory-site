<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/ 
if(isset($_POST['content']) && $_POST['content'] != ''){ 
    $title = $_POST['content']; 
    
    // ChatGPT API endpoint and API key
    $endpoint = 'https://api.openai.com/v1/chat/completions';
    
    $api_key = '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'; 
    
    // Define conversation messages
    $messages = [
        [
            'role' => 'user',
            'content' => $title
        ]
    ];
    
    $data = array(
        'model' => 'gpt-3.5-turbo', // Or any other model you prefer
        'messages' => $messages,
        'max_tokens' => 100
    );
    
    $curl = curl_init($endpoint);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key
    ]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($curl);
    curl_close($curl);
    
    $result = json_decode($response, true);
    // print_r($result);
    // Output the generated text
    // echo json_encode(array('text' => $result['choices'][0]['message']['content']));
    
    $output = $result['choices'][0]['message']['content'];
    
    // Output the response as JSON
    header('Content-Type: application/json');
    echo json_encode($output);
}else{
    
}
?>

<?php
/* $output = array(
        'apple' => 'Fruit',
        'Brinjal' => 'Vegitable'
    );
// Output the response as JSON
header('Content-Type: application/json');
echo json_encode($output);*/
?>

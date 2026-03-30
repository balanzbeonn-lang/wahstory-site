<?php

if (isset($_POST['content']) && $_POST['content'] != '') {
    
    $apiKey = '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';
    
    $prevFullStory = $_POST['content'];

    // Step 1: Enhance the story
    $storyData = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            [
                'role' => 'system',
                'content' => 'You are a professional content editor and writer with over 10 years of professional experience.'
            ],
            [
                'role' => 'user',
                'content' => "Here is the story: \"$prevFullStory\". Rewrite this story by adding emotions while writing about an individual's personal challenges and overcoming. The story should begin with a compelling statement that resonates with the reader. The sections should be separated into 5 parts with html formatting and do not give any heading and title. Ensure each section is well-structured, curating a journey in a professional yet dramatic manner. Write in the first person, making the final story impactful and inspiring, ensuring it feels human rather than AI-generated. Keep the story within a maximum of 1000 words."
            ]
        ]
    ];

    // Send request to OpenAI API for the enhanced story
    $enhancedStory = sendOpenAIRequest($storyData, $apiKey);

    if (!$enhancedStory) {
        sendErrorResponse("Failed to generate story.");
        exit;
    }

    // Step 2: Generate a title for the story
    $titleData = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            [
                'role' => 'system',
                'content' => 'You are a professional title generator for articles and stories.'
            ],
            [
                'role' => 'user',
                'content' => "Based on the following story, generate a compelling, concise, and engaging title: \"$enhancedStory\"."
            ]
        ]
    ];

    // Send request to OpenAI API for the title
    $generatedTitle = sendOpenAIRequest($titleData, $apiKey);

    if (!$generatedTitle) {
        sendErrorResponse("Failed to generate title.");
        exit;
    }

    // Step 3: Return the story and title
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'story' => $enhancedStory,
        'title' => $generatedTitle
    ]);
} else {
    sendErrorResponse("Something went wrong!");
}

/**
 * Function to send a request to OpenAI API
 */
function sendOpenAIRequest($data, $apiKey) {
    $jsonData = json_encode($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log('cURL error: ' . curl_error($ch));
        return false;
    }

    curl_close($ch);

    $responseArray = json_decode($response, true);
    if (isset($responseArray['choices'][0]['message']['content'])) {
        return $responseArray['choices'][0]['message']['content'];
    }

    return false;
}

/**
 * Function to send an error response
 */
function sendErrorResponse($message) {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => $message
    ]);
}

<?php

// The URL to send the GET request to
$url = "https://api.payfast.co.za/process/query/b5a711b0-685c-40c5-aa44-b1f98a1a49d8?testing=true";

$timestamp = (new DateTime())->format('Y-m-d\TH:i:sP');

// Initialize a cURL session
$curl = curl_init();

error_log($timestamp);

$passPhrase="omenesa20132024";

$pfData = [
    "merchant-id" => "10035158",
    "timestamp" => $timestamp,
    "version" => "v1"
];

// Set the headers


if ($passPhrase !== null) {
    $pfData['passphrase'] = $passPhrase;
}

// Sort the array by key, alphabetically
ksort($pfData);

//create parameter string
$pfParamString = http_build_query($pfData);

error_log($pfParamString);

$signature=md5($pfParamString);

$headers = [
    'merchant-id: 10035158',
    'signature: '. $signature,// Example of a custom header // Example Authorization header
    'timestamp: '. $timestamp, // Example Content-Type header
    'version: v1'
    
];

// Set the options for the cURL session
curl_setopt($curl, CURLOPT_URL, $url); // Set the URL
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Return the response as a string instead of outputting it
curl_setopt($curl, CURLOPT_HTTPGET, true); // Use GET method
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // Add the headers

// Execute the GET request
$response = curl_exec($curl);

// Check if there was an error
if ($response === false) {
    $error = curl_error($curl);
    echo "cURL Error: " . $error;
} else {
    error_log($response);
    // Output the response
    echo "Response: " . $response;
}

// Close the cURL session
curl_close($curl);

?>
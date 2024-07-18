<?php
require_once('./api.php');

$url = 'https://v6.exchangerate-api.com/v6/' . $apiKey . '/codes';

$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
]);

$response = curl_exec($ch);
$err = curl_error($ch);

curl_close($ch);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $data = json_decode($response, true);
    $currencies = $data['supported_codes'];
}
?> 


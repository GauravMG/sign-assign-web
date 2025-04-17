<?php

function callApi($url, $data = [])
{
    $client = \Config\Services::curlrequest();

    $options = [
        'http_errors' => false, // Prevent exceptions on non-200 responses
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ],
    ];

    if (!empty($data)) {
        $options['json'] = $data;
    }

    $method = "POST";

    $response = $client->request($method, "http://3.109.198.252/api/" . $url, $options);
    return json_decode($response->getBody(), true);
}

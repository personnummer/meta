<?php

// Generate an JSON list with test­­samordningsnummer from Skatteverket api.
//
// Info from Skatteverket:
// Numbers with century numbers, ie 12 characters long, that only in the test environment can never buy in production.
// Numbers are available for the years 1914-2023. New test numbers are added in January each year.

$startUrl = 'https://skatteverket.entryscape.net/rowstore/dataset/9f29fe09-4dbc-4d2f-848f-7cffdd075383';

function fetch_numbers($url) {
    print("Fetching $url\n");

    $options = [
        'http' => [
            'method'  => 'GET',
            'header'=>  "Content-Type: application/json\r\n"
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $json = json_decode($result, 1);
    $list = array_map(function ($item) {
        return $item['samordningsnummer'];
    }, $json['results']);

    if (!empty($json['next'])) {
        return array_merge($list, fetch_numbers($json['next']));
    }

    return $list;
}

$list = fetch_numbers($startUrl);

file_put_contents(__DIR__ . '/allCoords.json', json_encode($list, JSON_PRETTY_PRINT));

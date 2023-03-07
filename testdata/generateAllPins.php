<?php

// Generate an JSON list with testpersonnummer from Skatteverket api.
//
// Info from Skatteverket:
// Numbers with century numbers, ie 12 characters long, that only in the test environment can never buy in production.
// Numbers are available for the years 1890-2023. New test numbers are added in January each year.

$startUrl = 'https://skatteverket.entryscape.net/rowstore/dataset/b4de7df7-63c0-4e7e-bb59-1f156a591763';

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
        return $item['testpersonnummer'];
    }, $json['results']);

    $list = array_filter($list, function ($item) {
        return !empty($item);
    });

    if (!empty($json['next'])) {
        return array_merge($list, fetch_numbers($json['next']));
    }

    return $list;
}

$list = fetch_numbers($startUrl);

file_put_contents(__DIR__ . '/allPins.json', json_encode($list, JSON_PRETTY_PRINT));

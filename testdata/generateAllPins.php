<?php

// Generate an JSON list of Skatteverket test csv.
//
// Info from Skatteverket:
// Numbers with century numbers, ie 12 characters long, that only in the test environment can never buy in production.
// Numbers are available for the years 1890-2019. New test numbers are added in January each year.

$list    = [];
$csvUrls = [
    'https://skatteverket.entryscape.net/store/9/resource/149',
    'https://skatteverket.entryscape.net/store/9/resource/535',
    'https://skatteverket.entryscape.net/store/9/resource/686',
    'https://skatteverket.entryscape.net/store/9/resource/1026',
    'https://skatteverket.entryscape.net/store/9/resource/1271',
    'https://skatteverket.entryscape.net/store/9/resource/1580'
];

foreach ($csvUrls as $url) {
    $csv = file_get_contents($url);
    $csv = trim($csv);

    $lines = str_getcsv($csv, "\n");
    $lines = array_map('trim', $lines);
    array_shift($lines);

    $list = array_merge($list, $lines);
}

file_put_contents(__DIR__ . '/allPins.json', json_encode($list, JSON_PRETTY_PRINT));

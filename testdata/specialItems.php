<?php

function createInterimNumbers() {
    $numbers = [];
    $letters = ['P', 'T','R','S','U','W','X','J','K','L','M','N'];
    foreach ($letters as $letter) {
        $numbers[] = [
            "integer" => 0,
            "long_format" => sprintf("20000101%s220",$letter),
            "short_format" => sprintf("000101%s220",$letter),
            "separated_format" => sprintf("000101-%s220",$letter),
            "separated_long" => sprintf("20000101-%s220",$letter),
            "valid" => false,
            "type" => "interim",
            "isMale" => false,
            "isFemale" => false,
        ];
    }
    return $numbers;
}

$specialItems = [
    // meta@#41
    [
        "integer" => 0,
        "long_format" => "19090527 1474",
        "short_format" => "090527 1474",
        "separated_format" => "090527 1474",
        "separated_long" => "19090527 1474",
        "valid" => false,
        "type" => "ssn",
        "isMale"=> true,
        "isFemale"=> false,
    ],
    ...createInterimNumbers(),
    // spec v3.1
    [
        "integer" => 0,
        "long_format" => "20000101A220",
        "short_format" => "000101A220",
        "separated_format" => "000101-A220",
        "separated_long" => "20000101-A220",
        "valid" => false,
        "type" => "interim",
        "isMale" => false,
        "isFemale" => false,
    ],
];
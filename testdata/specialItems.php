<?php

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
    // spec v3.1
    [
        "long_format" => "20000101T220",
        "short_format" => "000101T220",
        "separated_format" => "000101-T220",
        "separated_long" => "20000101-T220",
        "valid" => true,
        "type" => "interim",
        "isMale" => false,
        "isFemale" => true,
    ],
    [
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
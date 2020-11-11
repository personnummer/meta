<?php
$structured = [];

function randomNum(bool $male): int
{
    // 9880 - 9999 is defined as valid test series
    $num = rand(988, 999);

    if ($num % 2 !== intval($male)) {
        $num = min($num + 1, 998 + intval($male));
    }

    return $num;
}

function randomDate(int $year = 0, $con = false): string
{
    $randomTimestamp = mt_rand((new DateTime)->modify('-90 years')->getTimestamp(), (new DateTime())->getTimestamp());
    $randomDate      = new DateTime();
    $randomDate->setTimestamp($randomTimestamp);

    if ($year < 0) {
        $randomDate->modify(sprintf('%d years', $year));
    } elseif ($year > 0) {
        $randomDate->setDate($year, $randomDate->format('m'), $randomDate->format('d'));
    }

    if ($con) {
        return $randomDate->format('Ym') . strval(intval($randomDate->format('d')) + 60);
    }

    return $randomDate->format('Ymd');
}

function luhn(string $str): int
{
    $sum = 0;

    for ($i = 0; $i < strlen($str); $i++) {
        $v = intval($str[$i]);
        $v *= 2 - ($i % 2);

        if ($v > 9) {
            $v -= 9;
        }

        $sum += $v;
    }

    return intval(ceil($sum / 10) * 10 - $sum);
}

function randomSSN(int $year = 0, bool $con = false, bool $male = true): string
{
    return randomDate($year, $con) . randomNum($male);
}

function createListObjectItem(string $longFormat, bool $con = false, bool $male = true, bool $valid = true)
{
    $integer     = intval($longFormat);
    $shortFormat = substr($longFormat, 2);

    $separator       = date('Y') - intval(substr($longFormat, 0, 4)) < 100 ? '-' : '+';
    $separatedFormat = preg_replace('/(\d{4})$/', $separator . '$1', $shortFormat, 1);
    $separatedLong   = preg_replace('/(\d{4})$/', $separator . '$1', $longFormat, 1);

    return [
        'integer'          => $integer,
        'long_format'      => $longFormat,
        'short_format'     => $shortFormat,
        'separated_format' => $separatedFormat,
        'separated_long'   => $separatedLong,
        'valid'            => $valid,
        'type'             => $con ? 'con' : 'ssn',
        'isMale'           => $male,
        'isFemale'         => !$male,
    ];
}

function createListObject(int $year = 0, bool $con = false, bool $male = true, bool $valid = true)
{
    $longFormat = randomSSN($year, $con, $male);

    $luhn = luhn(substr($longFormat, 2));

    if (!$valid) {
        $invalidLuhns = array_values(array_diff(range(0, 9), [$luhn]));
        $luhn         = $invalidLuhns[rand(0, count($invalidLuhns) - 1)];
    }

    $longFormat .= $luhn;

    return createListObjectItem($longFormat, $con, $male, $valid);
}

$list = [
    createListObjectItem('201509160006', false, false, false),
    createListObjectItem('190905271474', false, true, true) // js@#60
];

// Generate valid and invalid males and coordination number males
for ($i = 0; $i < 4; $i++) {
    $list[] = createListObject(0, $i > 1, true, boolval($i % 2));
}
// Generate valid and invalid females and coordination number females
for ($i = 0; $i < 4; $i++) {
    $list[] = createListObject(0, $i > 1, false, boolval($i % 2));
}

// Generate old person
$list[] = createListObject(-100);

// Generate person born 2000 (because of 00)
$list[] = createListObject(2000);

foreach ($list as $item) {
    $structured[$item['type']] = $structured[$item['type']] ?? [];
    foreach (['integer', 'long_format', 'short_format', 'separated_format', 'separated_long'] as $format) {
        $formatKey                             = is_int($item[$format]) ? 'integer' : 'string';
        $structured[$item['type']][$formatKey] = $structured[$item['type']][$formatKey] ?? [];

        $validKey                                         = $item['valid'] ? 'valid' : 'invalid';
        $structured[$item['type']][$formatKey][$validKey] = $structured[$item['type']][$formatKey][$validKey] ?? [];

        $structured[$item['type']][$formatKey][$validKey][] = $item[$format];
    }
}

file_put_contents(__DIR__ . '/list.json', json_encode($list, JSON_PRETTY_PRINT));
file_put_contents(__DIR__ . '/structured.json', json_encode($structured, JSON_PRETTY_PRINT));
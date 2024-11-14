<?php

$data = [
    [
        "id" => 1,
        "name" => "Alice",
        "email" => "alice@example.com",
        "age" => 25,
        "country" => "USA"
    ],
    [
        "id" => 2,
        "name" => "Bob",
        "email" => "bob@example.com",
        "age" => 17,
        "country" => "Canada"
    ],
    [
        "id" => 3,
        "name" => "Charlie",
        "email" => "charlie@example.com",
        "age" => 30,
        "country" => "USA"
    ],
    [
        "id" => 4,
        "name" => "Dana",
        "email" => "dana@example.com",
        "age" => 20,
        "country" => "Canada"
    ]
];

/**
* Function made with readability in mind. It is far worse in terms of performance than the second function.
* It iterates over the data array two times, while the second function iterates over it only once.
* However, it is easier to read and understand without any use of comments.
*/
function transformAndFilterData($data) : array {
    $result = array_filter($data, function($item) {
        return $item['age'] >= 18;
    });

    $result = array_map(function($item) {
        unset($item['email'], $item['age']);
        return $item;
    }, $result);

    $countries = array_column($result, 'country');
    $names = array_column($result, 'name');
    array_multisort($countries, SORT_ASC, $names, SORT_ASC, $result);

    return $result;
}

/**
* Function made with performence in mind.
* It iterates over the data array one time, filtering and transforming the data in the same loop.
* For larger arrays, usort will perform better than array_multisort.
*/
function transformAndFilterData2($data) : array {
    $result = [];
    
    foreach ($data as $item) {
        if ($item['age'] >= 18) {
            unset($item['email'], $item['age']);
            $result[] = $item;
        }
    }

    usort($result, function ($a, $b) {
        // Compare by country first
        $countryComparison = strcmp($a['country'], $b['country']);
        
        // If countries are the same, compare by name
        if ($countryComparison === 0) {
            return strcmp($a['name'], $b['name']);
        }
        
        return $countryComparison;
    });

    return $result;
}

$start1 = microtime(true);
$result1 = transformAndFilterData($data);
$timeElapsed1 = microtime(true) - $start1;
$start2 = microtime(true);
$result2 = transformAndFilterData2($data);
$timeElapsed2 = microtime(true) - $start2;

echo "<pre>";
print_r($timeElapsed1);
echo "<br>";
print_r($timeElapsed2);
echo "</pre>";
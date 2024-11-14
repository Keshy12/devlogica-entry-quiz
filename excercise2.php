<?php
$data = [
    "file1.txt" => 200,
    "file2.txt" => 300,
    "subdir1" => [
        "file3.txt" => 150,
        "file4.txt" => 250,
        "subdir2" => [
            "file5.txt" => 100
        ]
    ]
];

/**
* Might hit recursion depth limit.
* Depending on the input data, iterative approach might be better.
* Used array_reduce as I find it readable. Could've used foreach loop.
*/
function calculateDirectorySize($data): int {
    $size = array_reduce($data, function($carry, $item) {
        if (is_array($item)) {
            return $carry + calculateDirectorySize($item);
        }
        return $carry + $item;
    }, 0);
    
    return $size;
}

print_r(calculateDirectorySize($data));
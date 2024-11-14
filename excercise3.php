<?php
function convertTemperature($value, $fromUnit, $toUnit): float {  
    $convertionTable = [
        "C" => [
            "C" => function($value) { return $value; }, 
            "F" => function($value) { return ($value * 9/5) + 32; }, 
            "K" => function($value) { return $value + 273.15; }, 
        ],
        "F" => [
            "C" => function($value) { return ($value - 32) * 5/9; }, 
            "F" => function($value) { return $value; }, 
            "K" => function($value) { return ($value - 32) * 5/9 + 273.15; }, 
        ],
        "K" => [
            "C" => function($value) { return $value - 273.15; }, 
            "F" => function($value) { return ($value - 273.15) * 9/5 + 32; }, 
            "K" => function($value) { return $value; }, 
        ]
    ];
    
    if (!isset($convertionTable[$fromUnit][$toUnit])) {
        throw new InvalidArgumentException("Invalid temperature unit. Use 'C' for Celsius, 'F' for Fahrenheit, or 'K' for Kelvin.");
    }

    return round($convertionTable[$fromUnit][$toUnit]($value), 2);
}

echo convertTemperature(0, 'C', 'F');
echo "<br>";
echo convertTemperature(100, 'C', 'K');
echo "<br>";
echo convertTemperature(212, 'F', 'C');
echo "<br>";
echo convertTemperature(273.15, 'K', 'C');
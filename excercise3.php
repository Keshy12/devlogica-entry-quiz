<?php
function convertTemperature($value, $fromUnit, $toUnit): float {
    $validUnits = ['C', 'F', 'K'];

    if (!in_array($fromUnit, $validUnits) || !in_array($toUnit, $validUnits)) {
        throw new InvalidArgumentException("Invalid temperature unit. Use 'C' for Celsius, 'F' for Fahrenheit, or 'K' for Kelvin.");
    }

    if ($fromUnit === $toUnit) {
        return round($value, 2);
    }

    switch ($fromUnit) {
        case 'C':
            if ($toUnit === 'F') {
                $result = ($value * 9/5) + 32;
            } 
            elseif ($toUnit === 'K') {
                $result = $value + 273.15;
            }
            break;
        case 'F':
            if ($toUnit === 'C') {
                $result = ($value - 32) * 5/9;
            } elseif ($toUnit === 'K') {
                $result = ($value - 32) * 5/9 + 273.15;
            }
            break;
        case 'K':
            if ($toUnit === 'C') {
                $result = $value - 273.15;
            } elseif ($toUnit === 'F') {
                $result = ($value - 273.15) * 9/5 + 32;
            }
            break;
    }

    return round($result, 2);
}

echo convertTemperature(0, 'C', 'F');
echo "<br>";
echo convertTemperature(100, 'C', 'K');
echo "<br>";
echo convertTemperature(212, 'F', 'C');
echo "<br>";
echo convertTemperature(273.15, 'K', 'C');
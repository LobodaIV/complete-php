<?php

$bmw = [
    "model" => "X5",
    "speed" => 120,
    "doors" => 5,
    "year"  => "2015",
];

$toyota = [
    "model" => "Camry",
    "speed" => 100,
    "doors" => 4,
    "year"  => "2008",
];

$opel = [
    "model" => "Corsa",
    "speed" => 100,
    "doors" => 5,
    "year" => "2006",
];

$cars = [
    "bmw" => $bmw,
    "toyota" => $toyota,
    "opel" => $opel,
];

foreach ($cars as $name => $car) {
    echo "CAR name: ${name} <br>";
    foreach ($car as $v) {
        echo " ${v} ";
    }
    echo "<br>";
}

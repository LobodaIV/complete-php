<?php

$age = mt_rand(1, 90);

if ($age >= 18 and $age <= 65) {
    echo "Вам еще работать и работать";
} elseif ($age == 65) {
    echo "Вам пора на пенсию";
} elseif ($age < 18) {
    echo "Вам еще рано работать";
} else {
    echo "Неизвестный возраст";
}

<?php

require "src/functions.php";

task1(["str1","str2","str3","str4"], true);
echo '<br>';
echo task2("+", 1, 2, 3);
echo '<br>';
echo task2("-", 1, 1, 1);
echo '<br>';
echo task2("/", 8, 2, 2);
echo '<br>';
echo task2("*", 3, 3, 3);
echo '<br>';
task3(8,8);
task4();
echo '<br>';
task5("24.02.2016 00:00:00");
echo '<br>';
task6("Карл у Клары украл Кораллы");
echo '<br>';
task7("Две бутылки лимонада");

$f = fopen("test.txt", "wb");
fwrite($f, "Hello Again!");
fclose($f);

task8("test.txt");

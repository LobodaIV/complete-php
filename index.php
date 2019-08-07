<?php

include_once("ns\\basic.php");
include_once("ns\\hourly.php");
include_once("ns\\daily.php");
include_once("ns\\student.php");

use Tariff\Basic\Basic;
use Tariff\Hourly\Hourly;
use Tariff\Daily\Daily;
use Tariff\Student\Student;

//$basic = new Basic(5,1,20);
//$basic->countPrice();
//$basic1 = new Basic(5,1,20, ["GPS" => 2]);
//$basic1->countPrice();

//
//$hourly = new Hourly(10,20,["Driver"]);
//$hourly->countPrice();

//$daily = new Daily(23,59,20);
//$daily->countPrice();
//
//$daily2 = new Daily("40",0,30,["Driver"]);
//$daily2->countPrice();

$student = new Student(100,20,24, ["GPS" => 24]);
$student->countPrice();
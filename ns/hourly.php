<?php

namespace Tariff\Hourly;

include_once("tariff.php");
include_once("services.php");

use \Tariff\Tariff;
use \Tariff\AddServices\GPS;
use \Tariff\AddServices\Driver;

class Hourly extends Tariff
{
    use GPS;
    use Driver;

    public function __construct($time, $age, $additionalService = [])
    {
        $this->_time = ceil($time);
        $this->_age = (int)$age;
        $this->_additionalService = $additionalService;
        $this->_perHour = 200;

        if (!empty($additionalService)) {

            if (array_key_exists("GPS", $additionalService)) {
                $this->setGpsHours($time);
                $this->_gps = true;
            } elseif ( isset($additionalService[0]) and $additionalService[0] == "Driver") {
                $this->_driver = true;
            } else {
                echo "We have no such service";
            }
        }
    }
}
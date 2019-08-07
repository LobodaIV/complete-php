<?php

namespace Tariff\Basic;

include_once("tariff.php");
include_once("services.php");

use \Tariff\Tariff;
use \Tariff\AddServices\GPS;

class Basic extends Tariff
{
    use GPS;

    public function __construct($distance, $time, $age, $additionalService = [])
    {
        $this->_distance = (int)$distance;
        $this->_time = (int)$time;
        $this->_age = (int)$age;
        $this->_additionalService = $additionalService;
        $this->_pricePerKm = 10;
        $this->_perMin = 3;

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

        $this->hoursToMin();
    }
}
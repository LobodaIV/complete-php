<?php

namespace Tariff\Daily;

include_once("tariff.php");
include_once("services.php");

use \Tariff\Tariff;
use \Tariff\AddServices\GPS;
use \Tariff\AddServices\Driver;

class Daily extends Tariff
{
    use GPS;
    use Driver;

    public function __construct($time, $min, $age, $additionalService = [])
    {
        $this->_time = (int)$time;
        $this->_min = (int)$min;
        $this->_age = (int)$age;
        $this->_additionalService = $additionalService;
        $this->_pricePerKm = 1;
        $this->_pricePer24Hours = 1000;

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

        $this->convertToDays();
    }

    protected function convertToDays()
    {
        if($this->_min >= 30 or $this->_time < 24) {
            $this->_time = 1;
        } else {
            $this->_time = ceil($this->_time / 24);
        }
    }

}
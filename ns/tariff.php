<?php

namespace Tariff;

interface iTariff
{
    public function countPrice();
}

abstract class Tariff implements \Tariff\iTariff
{
    protected $_pricePerKm;
    protected $_perMin;
    protected $_perHour;
    protected $_pricePer24Hours;
    protected $_distance;
    protected $_time;
    protected $_min;
    protected $_age;
    protected $_additionalService;
    protected $_percent;
    protected $_gps;
    protected $_driver;

    public function countPrice()
    {
        if ($this->checkAge()) {

            if (get_class($this) == "Tariff\Basic\Basic") {
                if ($this->_gps) {
                    echo ($this->_distance * $this->_pricePerKm) + ($this->_time * $this->_perMin) + $this->_percent
                        + $this->gpsServicePrice();
                } else {
                    echo ($this->_distance * $this->_pricePerKm) + ($this->_time * $this->_perMin) + $this->_percent;
                }
            } elseif (get_class($this) == "Tariff\Hourly\Hourly") {
                if ($this->_gps) {
                    echo ($this->_time * $this->_perHour) + $this->_percent + $this->gpsServicePrice();
                } elseif ($this->_driver) {
                    echo ($this->_time * $this->_perHour) + $this->_percent + $this->driverServicePrice();
                } else {
                    echo ($this->_time * $this->_perHour) + $this->_percent;
                }
            } elseif (get_class($this) == "Tariff\Daily\Daily") {
                if ($this->_gps) {
                    echo $this->_time * $this->_pricePer24Hours + $this->_percent + $this->gpsServicePrice();
                } elseif ($this->_driver) {
                    echo $this->_time * $this->_pricePer24Hours + $this->_percent + $this->driverServicePrice();
                } else {
                    echo $this->_time * $this->_pricePer24Hours + $this->_percent;
                }
            } elseif (get_class($this) == "Tariff\Student\Student") {
                if ($this->_gps) {
                    echo ($this->_distance * $this->_pricePerKm) + ($this->_time * $this->_perMin) + $this->_percent
                        + $this->gpsServicePrice();
                } else {
                    echo ($this->_distance * $this->_pricePerKm) + ($this->_time * $this->_perMin) + $this->_percent;
                }
            }
        }
    }

    protected function checkAge()
    {
        if ($this->_age < 18 or $this->_age > 65) {
            return false;
        } elseif ($this->_age >= 18 and $this->_age <= 21) {
            $this->setPercent();
            return true;
        } elseif (get_class($this) == "Tariff\Student\Student" and $this->_age == 25 ) {
            return false;
        } else {
            return true;
        }
    }

    protected function setPercent()
    {
        if (get_class($this) == "Tariff\Basic\Basic") {
            $this->_percent = (($this->_distance * $this->_pricePerKm) + ($this->_time * $this->_perMin)) / 10;
        } elseif (get_class($this) == "Tariff\Hourly\Hourly") {
            $this->_percent = ($this->_time * $this->_perHour) / 10;
        } elseif (get_class($this) == "Tariff\Daily\Daily") {
            $this->_percent = ($this->_time * $this->_pricePer24Hours) / 10;
        }
    }

    protected function hoursToMin()
    {
        $this->_time *= 60;
    }
}
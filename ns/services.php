<?php

namespace Tariff\AddServices;

trait GPS
{
    private $_hours = null;

    public function gpsServicePrice()
    {
        return 15 * (int)$this->_hours;
    }

    public function setGpsHours($hours)
    {
        $this->_hours = $hours;
    }
}

trait Driver
{
    private $_oneTimePrice = 100;

    public function driverServicePrice()
    {
        return $this->_oneTimePrice;
    }
}
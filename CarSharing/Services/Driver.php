<?php

namespace CarSharing\Services;

trait Driver
{
    private $oneTimePrice = 100;
    private $isDriver = false;

    public function driverServicePrice()
    {
        return $this->oneTimePrice;
    }

    public function getDriverStatus()
    {
        return $this->isDriver;
    }

    public function setDriverStatus($flag)
    {
        $this->isDriver = $flag;
    }
}
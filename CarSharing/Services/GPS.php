<?php

namespace CarSharing\Services;

trait GPS
{
    private $pricePerGpsHour = 15;
    private $hoursWithGps = null;
    private $isGps = false;

    public function gpsServicePrice()
    {
        return $this->pricePerGpsHour * $this->hoursWithGps;
    }

    public function setGpsParams($params)
    {
        if ($params) {
            $this->isGps = true;
            $this->hoursWithGps = $params["GPS"];
        }
    }

    public function getGpsStatus()
    {
        return $this->isGps;
    }

    public function getGpsHours()
    {
        return $this->hoursWithGps;
    }
}
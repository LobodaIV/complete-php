<?php

namespace CarSharing\Tariff;

use \CarSharing\Base\Base;
use \CarSharing\Services\GPS;

class Basic extends Base
{
    use GPS;

    protected $distance;
    protected $time;
    protected $age;
    protected $pricePerKm = 10;
    protected $pricePerMin = 3;

    public function __construct($distance, $time, $age, $additionalService = [])
    {
        $this->distance = (int)$distance;
        $this->time = (int)$time;
        $this->age = (int)$age;

        $this->turnHoursToMin();

        if ($this->checkAge()) {
            if (!empty($additionalService) and array_key_exists("GPS", $additionalService)) {
                $this->setGpsParams($additionalService);
            }
        }
    }

    public function countPrice()
    {
        if ($this->getGpsStatus()) {
            echo ($this->distance * $this->pricePerKm) + ($this->time * $this->pricePerMin) + $this->percent
                + $this->gpsServicePrice();
        } else {
            echo ($this->distance * $this->pricePerKm) + ($this->time * $this->pricePerMin) + $this->percent;
        }
    }

    protected function setPercent()
    {
      $this->percent = (($this->distance * $this->pricePerKm) + ($this->time * $this->pricePerMin)) / 10;
    }

    private function turnHoursToMin()
    {
        $this->time *= 60;
    }
}
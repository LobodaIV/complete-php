<?php

namespace CarSharing\Tariff;

use \CarSharing\Base\Base;
use \CarSharing\Services\GPS;

class Student extends Base
{
    use GPS;

    protected $distance;
    protected $time;
    protected $age;
    protected $pricePerKm = 4;
    protected $pricePerMin = 1;

    public function __construct($distance, $time, $age, $additionalService = [])
    {
        $this->distance = (int)$distance;
        $this->time = (int)$time;
        $this->age = $age;

        if ($age > 25) {
            echo "You can't use this tariff";
        } else {
            if ($this->checkAge()) {
                if (!empty($additionalService) and array_key_exists("GPS", $additionalService)) {
                    $this->setGpsParams($additionalService);
                }
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
        $this->percent = ($this->days * $this->pricePer24Hours) / 10;
    }

}
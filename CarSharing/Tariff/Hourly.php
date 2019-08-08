<?php

namespace CarSharing\Tariff;

use \CarSharing\Base\Base;
use \CarSharing\Services\GPS;
use \CarSharing\Services\Driver;

class Hourly extends Base
{
    use GPS;
    use Driver;

    protected $hours;
    protected $age;
    protected $perHour;

    public function __construct($hours, $age, $additionalService = [])
    {
        $this->hours = ceil($hours);
        $this->age = (int)$age;
        $this->perHour = 200;

        if ($this->checkAge()) {
            if (!empty($additionalService)) {
                if (array_key_exists("GPS", $additionalService)) {
                    $this->setGpsParams($additionalService);
                } elseif (isset($additionalService[0]) and $additionalService[0] == "Driver") {
                    $this->setDriverStatus(true);
                } else {
                    echo "We have no such service";
                }
            }
        }
    }

    public function countPrice()
    {
        if ($this->getGpsStatus()) {
            echo ($this->hours * $this->perHour) + $this->percent + $this->gpsServicePrice();
        } elseif ($this->getDriverStatus()) {
            echo ($this->hours * $this->perHour) + $this->percent + $this->driverServicePrice();
        } else {
            echo ($this->hours * $this->perHour) + $this->percent;
        }
    }

    protected function setPercent()
    {
        $this->percent = ($this->hours * $this->pricePerHour) / 10;
    }

}
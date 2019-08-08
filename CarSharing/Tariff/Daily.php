<?php

namespace CarSharing\Tariff;

use \CarSharing\Base\Base;
use \CarSharing\Services\GPS;
use \CarSharing\Services\Driver;

class Daily extends Base
{
    use GPS;
    use Driver;

    protected $hours;
    protected $min;
    protected $age;
    protected $pricePerKm = 1;
    protected $pricePer24Hours = 1000;
    protected $days;

    public function __construct($hours, $min, $age, $additionalService = [])
    {
        $this->hours = (int)$hours;
        $this->min = (int)$min;
        $this->age = (int)$age;
        $this->pricePerKm = 1;
        $this->pricePer24Hours = 1000;

        $this->convertToDays();

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
            echo $this->days * $this->_pricePer24Hours + $this->percent + $this->gpsServicePrice();
        } elseif ($this->driver) {
            echo $this->days * $this->_pricePer24Hours + $this->percent + $this->driverServicePrice();
        } else {
            //echo "Days - " . $this->days . " P"
            echo $this->days * $this->pricePer24Hours + $this->percent;
        }
    }

    protected function setPercent()
    {
        $this->percent = ($this->days * $this->pricePer24Hours) / 10;
    }

    protected function convertToDays()
    {
        if($this->min >= 30 or $this->hours < 24) {
            $this->days = 1;
        } else {
            $this->days = ceil($this->hours / 24);
        }
    }

}
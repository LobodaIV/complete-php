<?php

namespace CarSharing\Base;

interface iBase
{
    public function countPrice();
}

abstract class Base implements iBase
{
    protected $percent;

    abstract protected function setPercent();

    protected function checkAge()
    {
        if ($this->age < 18 or $this->age > 65) {
            return false;
        } elseif ($this->age <= 21) {
            $this->setPercent();
            return true;
        } else {
            return true;
        }
    }

}
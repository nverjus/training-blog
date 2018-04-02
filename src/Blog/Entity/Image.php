<?php
namespace Blog\Entity;

use NVFram\Entity;

class Image extends Entity
{
    protected $adress;

    public function setAdress($adress)
    {
        if (!empty($adress) && is_string($adress)) {
            $this->adress = $adress;
        }
    }

    public function getAdress()
    {
        return $this->adress;
    }
}

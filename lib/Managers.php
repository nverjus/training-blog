<?php
namespace NV;

class Managers
{
    private $dms;

    public function __construct($dms)
    {
        $this->dms = $dms;
    }
    public function getManagerOf(string $entity)
    {
        $manager = 'Model\\'.$entity.'Manager';

        if (!class_exists($manager)) {
            throw new \InvalidArgumentException('The required manager does not exists');
        }
        return new $manager($this->dms, $entity);
    }
}

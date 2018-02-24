<?php
namespace NV;

use Symfony\Component\Yaml\Yaml;

class Config
{
    private function read()
    {
        return Yaml::parseFile(__DIR__.'/../src/config/config.yml');
    }

    public function getDatabaseInfos()
    {
        $data = $this->read();
        return $data['database'];
    }
}

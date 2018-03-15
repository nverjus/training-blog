<?php
namespace NVFram;

use Symfony\Component\Yaml\Yaml;

class Config extends ApplicationComponent
{
    private function readConfigFile()
    {
        return Yaml::parseFile(__DIR__.'/../../src/'.$this->app->getName().'/config/config.yml');
    }

    public function getDatabaseInfos()
    {
        $data = $this->readConfigFile();
        return $data['database'];
    }

    public function getRoutes()
    {
        return Yaml::parseFile(__DIR__.'/../../src/'.$this->app->getName().'/config/routes.yml');
    }
}

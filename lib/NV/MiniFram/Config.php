<?php
namespace NV\MiniFram;

use Symfony\Component\Yaml\Yaml;

class Config extends ApplicationComponent
{
    private function readConfigFile()
    {
        return Yaml::parseFile(__DIR__.'/../../../src/'.$this->app->getName().'/config/config.yml');
    }

    public function getDatabaseInfos()
    {
        $data = $this->readConfigFile();
        return $data['database'];
    }

    public function getRoutes()
    {
        return Yaml::parseFile(__DIR__.'/../../../src/'.$this->app->getName().'/config/routes.yml');
    }


    public function getParameter($key)
    {
        $data = $this->readConfigFile();
        if (isset($data[$key])) {
            return $data[$key];
        }
        throw new \InvalidArgumentException('Parameter '.$key.' does not exists.');
    }
}

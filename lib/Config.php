<?php
namespace NV;

use Symfony\Component\Yaml\Yaml;

class Config extends ApplicationComponent
{
    private function read()
    {
        return Yaml::parseFile(__DIR__.'/../src/'.$this->app->getName().'/config/config.yml');
    }

    public function getDatabaseInfos()
    {
        $data = $this->read();
        return $data['database'];
    }
}

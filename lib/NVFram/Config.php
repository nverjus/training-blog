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

    public function getNBArticles()
    {
        $data = $this->readConfigFile();
        if (!isset($data['nb_articles']) || ((int) $data['nb_articles'] <= 0)) {
            $dta['nb_articles'] = 5;
        }
        return (int) $data['nb_articles'];
    }
}

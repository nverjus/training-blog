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

    public function getArticlesPerPage()
    {
        $data = $this->readConfigFile();
        if (!isset($data['articles_per_page']) || ((int) $data['articles_per_page'] <= 0)) {
            $data['articles_per_page'] = 5;
        }
        return (int) $data['articles_per_page'];
    }
}

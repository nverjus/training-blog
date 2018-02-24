<?php
namespace NV;

abstract class Controller
{
    protected $config;
    protected $managers;

    public function __construct()
    {
        $this->config = new Config;
        $this->managers = new Managers($this->config->getDatabaseInfos());
    }
}

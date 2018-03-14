<?php

namespace NV;

abstract class Application
{
    protected $request;
    protected $name;
    protected $config;

    public function __construct()
    {
        $this->request = new Request($this);
        $this->config = new Config($this);

        $this->name = '';
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getName()
    {
        return $this->name;
    }

    abstract public function run();
}

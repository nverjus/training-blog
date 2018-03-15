<?php
namespace NVFram;

abstract class Controller extends ApplicationComponent
{
    protected $manager;
    protected $action;

    public function __construct($app, $action)
    {
        parent::__construct($app);
        $this->managers = new Manager($this->app);
        $this->action = $action;
    }

    public function execute()
    {
    }
}

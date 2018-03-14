<?php
namespace NV;

abstract class Controller extends ApplicationComponent
{
    protected $manager;

    public function __construct($app)
    {
        parent::__construct($app)
        $this->managers = new Manager($this->app);
    }

    public function execute()
    {
    }
}

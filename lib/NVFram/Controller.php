<?php
namespace NVFram;

abstract class Controller extends ApplicationComponent
{
    protected $manager;
    protected $module;
    protected $action;

    public function __construct($app, $action, $module)
    {
        parent::__construct($app);
        $this->managers = new Manager($this->app);
        $this->action = $action;
        $this->module = $module;
    }

    public function execute()
    {
        $method = 'execute'.ucfirst($this->action);
        if (!is_callable([$this, $method])) {
            throw new \RuntimeException('the method \''. $method.'\' does not exists in  '.ucfirst($this->module).'Controller.');
        }
        return $this->$method($this->app->getRequest());
    }
}

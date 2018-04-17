<?php
namespace NV\MiniFram;

abstract class Repository extends ApplicationComponent
{
    protected $db;
    private $entity;

    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->db = PDOFactory::getDatabaseConnexion($this->app->getConfig()->getDatabaseInfos());
    }

    abstract public function findAll(bool $desc = true);

    abstract public function findById(int $id);
}

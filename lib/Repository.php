<?php
namespace NV;

abstract class Repository extends ApplicationComponent
{
    protected $db;
    private $entity;

    public function __construct($app, $entity)
    {
        parent::__construct($app);
        $this->db = PDOFactory::getDatabaseConnexion($this->app->getConfig());
        $this->entity = $entity;
    }

    public function findAll(bool $desc = false)
    {
        $class = $this->app->getName().'\\Entity\\'.$this->entity;
        $entities = [];
        $sql = "SELECT * FROM ".$this->entity;

        if ($desc) {
            $sql .= " ORDER BY id DESC";
        }

        $req = $this->db->query($sql);

        while ($row = $req->fetch()) {
            $entities[] = new $class($row);
        }
        $req->closeCursor();

        return $entities;
    }

    public function findById(int $id)
    {
        if ($id <= 0) {
            throw new \InvalidArgumentException('The id must be greater than zero');
        }
        $class = $this->app->getName().'\\Entity\\'.$this->entity;
        $sql = "SELECT * FROM ".$this->entity.' WHERE id='.$id;



        $req = $this->db->query($sql);

        return new $class($req->fetch());
    }
}

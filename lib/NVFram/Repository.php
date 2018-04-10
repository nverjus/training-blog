<?php
namespace NVFram;

abstract class Repository extends ApplicationComponent
{
    protected $db;
    private $entity;

    public function __construct($app, $entity)
    {
        parent::__construct($app);
        $this->db = PDOFactory::getDatabaseConnexion($this->app->getConfig()->getDatabaseInfos());
        $this->entity = $entity;
    }

    public function findAll(bool $desc = true)
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

        $req = $this->db->prepare('SELECT * FROM '.$this->entity.' WHERE id = :id');
        $req->bindValue(':id', (int) $id, \PDO::PARAM_INT);

        $req->execute();


        if ($data = $req->fetch()) {
            return new $class($data);
        }

        return null;
    }

    public function getLastId()
    {
        $req = $this->db->query("SELECT id FROM ".$this->entity.' ORDER BY id DESC LIMIT 1');
        $data = $req->fetch();
        return $data['id'];
    }
}

<?php
namespace NV;

abstract class Manager
{
    protected $db;
    private $entity;

    public function __construct($dms, $entity)
    {
        $this->db = PDOFactory::getMysqlConnexion($dms);
        $this->entity = $entity;
    }

    public function findAll(bool $desc = false)
    {
        $class = 'Entity\\'.$this->entity;
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
        $class = 'Entity\\'.$this->entity;
        $sql = "SELECT * FROM ".$this->entity.' WHERE id='.$id;



        $req = $this->db->query($sql);

        return new $class($req->fetch());
    }
}

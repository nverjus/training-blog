<?php
namespace Blog\Repository;

use NV\MiniFram\Repository;
use Blog\Entity\Image;

class ImageRepository extends Repository
{
    public function findById(int $id)
    {
        if ($id <= 0) {
            throw new \InvalidArgumentException('The id must be greater than zero');
        }

        $req = $this->db->prepare('SELECT * FROM Image WHERE id = :id');
        $req->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $req->execute();


        if ($data = $req->fetch()) {
            return new Image($data);
        }

        return null;
    }

    public function findAll(bool $desc = true)
    {
        $articles = [];
        $sql = "SELECT * FROM Article";

        if ($desc) {
            $sql .= " ORDER BY id DESC";
        }

        $req = $this->db->query($sql);

        while ($row = $req->fetch()) {
            $articles[] = new Article($row);
        }
        $req->closeCursor();

        return $articles;
    }

    public function getLastId()
    {
        $req = $this->db->query('SELECT id FROM Image ORDER BY id DESC LIMIT 1');
        $data = $req->fetch();
        return $data['id'];
    }

    public function save(Image $image)
    {
        {
            if ($image->isNew()) {
                $this->add($image);
            } else {
                $this->edit($image);
            }
        }
    }

    public function add(Image $image)
    {
        $req = $this->db->prepare('INSERT INTO Image SET adress = :adress');

        $req->bindValue(':adress', $image->getAdress());
        ;

        $req->execute();
    }

    public function edit(Image $image)
    {
        $req = $this->db->prepare('UPDATE Image SET adress = :adress WHERE id = :id');

        $req->bindValue(':adress', $image->getAdress());
        $req->bindValue(':id', $image->getId());

        $req->execute();
    }

    public function delete(Image $image)
    {
        $req = $this->db->prepare('DELETE FROM Image WHERE id = :id');
        $req->bindValue(':id', $image->getId());
        $req->execute();
    }
}

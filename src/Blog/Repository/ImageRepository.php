<?php
namespace Blog\Repository;

use NVFram\Repository;
use Blog\Entity\Image;

class ImageRepository extends Repository
{
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

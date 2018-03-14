<?php
namespace Blog\Repository;

use NV\Repository;
use Blog\Entity\Article;

class ArticleRepository extends Repository
{
    public function findLastX(int $numberOfArticle)
    {
        if ($numberOfArticle <= 0) {
            throw new \InvalidArgumentException('The number of Articles must be a positive integer');
        }
        $articles = [];

        $sql = "SELECT * FROM Article ORDER BY id DESC LIMIT ".$numberOfArticle;

        $req = $this->db->query($sql);

        while ($row = $req->fetch()) {
            $articles[] = new Article($row);
        }

        return $articles;
    }
}

<?php
namespace Blog\Repository;

use NV\MiniFram\Repository;
use Blog\Entity\Article;

class ArticleRepository extends Repository
{
    public function findById(int $id)
    {
        if ($id <= 0) {
            throw new \InvalidArgumentException('The id must be greater than zero');
        }
        $req = $this->db->prepare('SELECT * FROM Article WHERE id = :id');
        $req->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $req->execute();


        if ($data = $req->fetch()) {
            return new Article($data);
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

    public function findLastX(int $ArticlesPerPage, int $page)
    {
        if ($ArticlesPerPage <= 0) {
            throw new \InvalidArgumentException('The number of Articles must be a positive integer');
        }

        $offset = ($page -1) * $ArticlesPerPage;
        $articles = [];


        $req = $this->db->prepare('SELECT * FROM Article ORDER BY id DESC LIMIT :articlesPerPage OFFSET :ofset');
        $req->bindValue(':articlesPerPage', $ArticlesPerPage, \PDO::PARAM_INT);
        $req->bindValue(':ofset', $offset, \PDO::PARAM_INT);
        $req->execute();

        while ($row = $req->fetch()) {
            $articles[] = new Article($row);
        }

        return $articles;
    }

    public function getNbPages(int $ArticlesPerPage)
    {
        $sql = 'SELECT COUNT(id) AS nbArticles FROM Article';

        $req = $this->db->query($sql);
        $data = $req->fetch();
        $nbArticles = $data['nbArticles'];

        $nbPages = (int) $nbArticles/$ArticlesPerPage;
        $nbPages = (int) $nbPages;
        if ($nbArticles%$ArticlesPerPage != 0) {
            $nbPages++;
        }

        return $nbPages;
    }

    public function save(Article $article)
    {
        if ($article->isValid()) {
            if ($article->isNew()) {
                $this->add($article);
            } else {
                $this->edit($article);
            }
        }
    }

    public function add(Article $article)
    {
        $req = $this->db->prepare('INSERT INTO Article SET title = :title, subTitle = :subTitle, content = :content, publicationDate = NOW(), imageId = :imageId');

        $req->bindValue(':title', $article->getTitle());
        $req->bindValue(':subTitle', $article->getSubTitle());
        $req->bindValue(':content', $article->getContent());
        $req->bindValue(':imageId', $article->getImageId());

        $req->execute();
    }

    public function edit(Article $article)
    {
        $req = $this->db->prepare('UPDATE Article SET title = :title, subTitle = :subTitle, content = :content, publicationDate = NOW(), imageId = :imageId WHERE id = :id');

        $req->bindValue(':title', $article->getTitle());
        $req->bindValue(':subTitle', $article->getSubTitle());
        $req->bindValue(':content', $article->getContent());
        $req->bindValue(':imageId', $article->getImageId());
        $req->bindValue(':id', $article->getId());

        $req->execute();
    }

    public function delete(Article $article)
    {
        $req = $this->db->prepare('DELETE FROM Article WHERE id = :id');
        $req->bindValue(':id', $article->getId());
        $req->execute();
    }
}

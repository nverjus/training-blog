<?php
namespace Blog\Repository;

use NVFram\Repository;
use Blog\Entity\Article;

class ArticleRepository extends Repository
{
    public function findLastX(int $ArticlesPerPage, int $page)
    {
        if ($ArticlesPerPage <= 0) {
            throw new \InvalidArgumentException('The number of Articles must be a positive integer');
        }

        $offset = ($page -1) * $ArticlesPerPage;
        $articles = [];

        $sql = 'SELECT * FROM Article ORDER BY id DESC LIMIT '.$ArticlesPerPage.' OFFSET '.$offset;

        $req = $this->db->query($sql);

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
                $this->modify($article);
            }
        }
    }

    public function add(Article $article)
    {
        $req = $this->db->prepare('INSERT INTO Article SET title = :title, subTitle = :subTitle, content = :content, publicationDate = NOW()');

        $req->bindValue(':title', $article->getTitle());
        $req->bindValue(':subTitle', $article->getSubTitle());
        $req->bindValue(':content', $article->getContent());

        $req->execute();
    }
}

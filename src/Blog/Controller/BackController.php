<?php
namespace Blog\Controller;

use NVFram\Controller;
use NVFram\Request;
use Blog\Entity\Image;
use Blog\Entity\Article;

class BackController extends Controller
{
    public function executeAdminIndex(Request $request)
    {
        $ArticleRepo = $this->manager->getRepository('Article');

        $articles = $ArticleRepo->findAll();

        return $this->render('Back/adminIndex.html.twig', array('articles' => $articles));
    }

    public function executeArticleAdd(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $article = new Article(array());

            $article->setTitle($_POST['title']);
            $article->setSubTitle($_POST['subTitle']);
            $article->setContent($_POST['content']);

            if ($article->isValid()) {
                $this->manager->getRepository('Article')->save($article);
                $this->app->getResponse()->redirect('/admin');
            }
        }
        return $this->render('Back/articleAdd.html.twig');
    }
}

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
        $article = new Article(array());


        if ($request->getMethod() == 'POST') {
            $article->setTitle($request->postData('title'));
            $article->setSubTitle($request->postData('subTitle'));
            $article->setContent($request->postData('content'));

            if ($article->isValid()) {
                $this->manager->getRepository('Article')->save($article);
                $this->app->getResponse()->redirect('/admin');
            }
        }
        return $this->render('Back/articleAdd.html.twig', array('article' => $article));
    }

    public function executeArticleEdit(Request $request)
    {
        if ($request->getExists('id') && $request->getData('id') > 0) {
            $article = $this->manager->getRepository('Article')->findById($request->getData('id'));

            if ($article === null) {
                $this->app->getResponse()->redirect404();
            }

            if ($request->getMethod() == 'POST') {
                $article->setTitle($request->postData('title'));
                $article->setSubTitle($request->postData('subTitle'));
                $article->setContent($request->postData('content'));

                if ($article->isValid()) {
                    $this->manager->getRepository('Article')->save($article);
                    $this->app->getResponse()->redirect('/admin');
                }
            }
            return $this->render('Back/articleEdit.html.twig', array('article' => $article));
        }
    }
}

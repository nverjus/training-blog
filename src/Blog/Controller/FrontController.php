<?php
namespace Blog\Controller;

use NVFram\Controller;
use NVFram\Request;

class FrontController extends Controller
{
    public function executeIndex(Request $request)
    {
        $articles = $this->manager->getRepository('Article')->findLastX($this->app->getConfig()->getNBArticles());
        return $this->render('Front/index.html.twig', array('articles' => $articles));
    }

    public function executeArticleview(Request $request)
    {
        if ($request->getExists('id') && $request->getData('id') > 0) {
            $article = $this->manager->getRepository('Article')->findById($request->getData('id'));

            if ($article === null) {
                $this->app->getResponse()->redirect404();
            }
            return $this->render('Front/articleView.html.twig', array('article' => $article));
        }
    }
}

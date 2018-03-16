<?php
namespace Blog\Controller;

use NVFram\Controller;
use NVFram\Request;

class FrontController extends Controller
{
    public function executeIndex(Request $request)
    {
        return $this->render('index.html.twig', array('a' => 'HAHAHAHAHAHA'));
    }

    public function executeArticleview(Request $request)
    {
        if ($request->getExists('id') && $request->getData('id') > 0) {
            $article = $this->manager->getRepository('Article')->findById($request->getData('id'));

            if ($article === null) {
                $this->app->getResponse()->redirect404();
            }
            return $this->render('articleView.html.twig', array('article' => $article));
        }
    }
}

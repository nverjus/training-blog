<?php
namespace Blog\Controller;

use NV\MiniFram\Controller;
use NV\MiniFram\Request;
use Blog\Form\ArticleFormBuilder;
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
        $article->setImage(new Image(array()));

        if ($request->getMethod() == 'POST') {
            $article->setTitle($request->postData('title'));
            $article->setSubTitle($request->postData('subTitle'));
            $article->setContent($request->postData('content'));
        }
        $formBuilder = new ArticleFormBuilder($article);

        $formBuilder->build();
        $form = $formBuilder->getForm();

        if ($request->getMethod() == 'POST' && $form->isValid()) {
            $this->saveArticle($article, $request);

            $this->app->getSession()->setAttribute('flash', 'L\'article à bien été ajouté');
            $this->app->getResponse()->redirect('/admin');
        }

        return $this->render('Back/articleAdd.html.twig', array('form' => $form->createView()));
    }

    public function executeArticleEdit(Request $request)
    {
        if ($request->getExists('id') && $request->getData('id') > 0) {
            $article = $this->manager->getRepository('Article')->findById($request->getData('id'));

            if ($article === null) {
                $this->app->getResponse()->redirect404();
            }
            if ($article->getImageId() !== null) {
                $article->setImage($this->manager->getRepository('Image')->findById($article->getImageId()));
            } else {
                $article->setImage(new Image(array()));
            }
            if ($request->getMethod() == 'POST') {
                $article->setTitle($request->postData('title'));
                $article->setSubTitle($request->postData('subTitle'));
                $article->setContent($request->postData('content'));
            }

            $formBuilder = new ArticleFormBuilder($article);

            $formBuilder->build();
            $form = $formBuilder->getForm();

            if ($request->getMethod() == 'POST' && $form->isValid()) {
                $this->saveArticle($article, $request);

                $this->app->getSession()->setAttribute('flash', 'L\'article à bien été modifié');
                $this->app->getResponse()->redirect('/admin');
            }
        }
        return $this->render('Back/articleEdit.html.twig', array('article' => $article, 'form' => $form->createView()));
    }


    public function executeArticleDelete(Request $request)
    {
        $article = $this->manager->getRepository('Article')->findById($request->getData('id'));
        if ($article !== null) {
            $this->manager->getRepository('Article')->delete($article);
            if ($article->getImageId() !== null) {
                $article->setImage($this->manager->getRepository('Image')->findById($article->getImageId()));
                $this->manager->getRepository('Image')->delete($article->getImage());
                $article->getImage()->removeFile($this->app->getConfig()->getParameter('upload_dir'));
            }
            $this->app->getSession()->setAttribute('flash', 'L\'article à bien été supprimé');
        } else {
            $this->app->getSession()->setAttribute('flash', 'L\'article n\'existe pas');
        }
        $this->app->getResponse()->redirect('/admin');
    }

    public function executeImageDelete(Request $request)
    {
        $article = $this->manager->getRepository('Article')->findById($request->getData('id'));
        if ($article !== null) {
            if ($article->getImageId() !== null) {
                $article->setImage($this->manager->getRepository('Image')->findById($article->getImageId()));
                $article->setImageId(null);
                $this->manager->getRepository('Article')->save($article);
                $this->manager->getRepository('Image')->delete($article->getImage());
                $article->getImage()->removeFile($this->app->getConfig()->getParameter('upload_dir'));
                $article->setImageId(null);
                $this->manager->getRepository('Article')->save($article);
                $this->app->getSession()->setAttribute('flash', 'L\'image à bien été supprimée');
            } else {
                $this->app->getSession()->setAttribute('flash', 'L\'article n\'a pas d\'image');
            }
        } else {
            $this->app->getSession()->setAttribute('flash', 'L\'article n\'existe pas');
        }
        $this->app->getResponse()->redirect('/admin');
    }

    public function saveArticle(Article $article, Request $request)
    {
        if (!empty($article->getImage()->getAdress())) {
            $article->getImage()->removeFile($this->app->getConfig()->getParameter('upload_dir'));
        }
        if (!empty($request->fileData('image')['name'])) {
            $article->getImage()->uploadFile($request->fileData('image'), $this->app->getConfig()->getParameter('upload_dir'));
            $this->manager->getRepository('Image')->save($article->getImage());
            $article->setImageId($this->manager->getRepository('Image')->getLastId());
        } else {
            $article->setImageId(null);
        }

        $this->manager->getRepository('Article')->save($article);
    }
}

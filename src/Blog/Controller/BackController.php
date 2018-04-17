<?php
namespace Blog\Controller;

use NV\MiniFram\Controller;
use NV\MiniFram\Request;
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
        $image = new Image(array());

        if ($request->getMethod() == 'POST') {
            $article->setTitle($request->postData('title'));
            $article->setSubTitle($request->postData('subTitle'));
            $article->setContent($request->postData('content'));

            $image->uploadFile($request->fileData('image'), $this->app->getConfig()->getParameter('upload_dir'));
            if ($image->getAdress() !== null) {
                $this->manager->getRepository('Image')->save($image);
                $article->setImageId($this->manager->getRepository('Image')->getLastId());
            } else {
                $article->setImageId(null);
            }

            if ($article->isValid()) {
                $this->manager->getRepository('Article')->save($article);
                $this->app->getSession()->setFlash('L\'article à bien été ajouté');
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
            if ($article->getImageId() !== null) {
                $article->setImage($this->manager->getRepository('Image')->findById($article->getImageId()));
            }
            if ($request->getMethod() == 'POST') {
                $article->setTitle($request->postData('title'));
                $article->setSubTitle($request->postData('subTitle'));
                $article->setContent($request->postData('content'));

                if ($article->isValid()) {
                    if ($request->fileData('image')['name'] !== null && $request->fileData('image')['name'] !== '') {
                        if ($article->getImage() === null) {
                            $image = new Image(array());
                            $article->setImage($image);
                        }
                        $article->getImage()->removeFile($this->app->getConfig()->getParameter('upload_dir'));
                        $article->getImage()->uploadFile($request->fileData('image'), $this->app->getConfig()->getParameter('upload_dir'));

                        $this->manager->getRepository('Image')->save($image);
                        $article->setImageId($this->manager->getRepository('Image')->getLastId());
                    }
                    $this->app->getSession()->setFlash('L\'article à bien été modifié');
                    $this->manager->getRepository('Article')->save($article);
                    $this->app->getResponse()->redirect('/admin');
                }
            }
            return $this->render('Back/articleEdit.html.twig', array('article' => $article));
        }
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
            $this->app->getSession()->setFlash('L\'article à bien été supprimé');
        } else {
            $this->app->getSession()->setFlash('L\'article n\'existe pas');
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
                $this->app->getSession()->setFlash('L\'image à bien été supprimée');
            } else {
                $this->app->getSession()->setFlash('L\'article n\'a pas d\'image');
            }
        } else {
            $this->app->getSession()->setFlash('L\'article n\'existe pas');
        }
        $this->app->getResponse()->redirect('/admin');
    }
}

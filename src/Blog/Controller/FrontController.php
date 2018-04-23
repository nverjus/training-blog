<?php
namespace Blog\Controller;

use NV\MiniFram\Controller;
use NV\MiniFram\Request;
use NV\MiniFram\Mailer;
use Blog\Entity\Image;
use Blog\Entity\ContactMail;
use Blog\Form\ContactMailFormBuilder;

class FrontController extends Controller
{
    public function executeIndex(Request $request)
    {
        $page = $request->getData('page');
        $ArticleRepo = $this->manager->getRepository('Article');
        $nbPages = $ArticleRepo->getNbPages($this->app->getConfig()->getParameter('articles_per_page'));
        if ($page === '') {
            $page = 1;
        }
        if ($page <= 0 || $page > $nbPages) {
            $this->app->getResponse()->redirect404();
        }
        $articles = $ArticleRepo->findLastX($this->app->getConfig()->getParameter('articles_per_page'), (int) $page);
        $nbPages = $ArticleRepo->getNbPages($this->app->getConfig()->getParameter('articles_per_page'));

        return $this->render('Front/index.html.twig', array(
          'articles' => $articles,
          'page' => (int) $page,
          'nbPages'=> (int) $nbPages,
        ));
    }

    public function executeArticleview(Request $request)
    {
        if ($request->getExists('id') && $request->getData('id') > 0) {
            $article = $this->manager->getRepository('Article')->findById($request->getData('id'));

            if ($article === null) {
                $this->app->getResponse()->redirect404();
            }
            if ($article->getImageId() !== null) {
                $article->setImage($this->manager->getRepository('Image')->findById($article->getImageId()));
            } elseif ($article->getImageId() === null) {
                $article->setImage(new Image(array('adress' => 'home-bg.jpg')));
            }

            return $this->render('Front/articleView.html.twig', array('article' => $article));
        }
    }

    public function executeContact(Request $request)
    {
        $mail = new ContactMail([]);

        if ($request->getMethod() == 'POST') {
            $mail->setName($request->postData('name'));
            $mail->setEmail($request->postData('email'));
            $mail->setContent($request->postData('content'));
        }

        $builder = new ContactMailFormBuilder($mail);
        $builder->build();
        $form = $builder->getForm();

        if ($request->getMethod() == 'POST' && $form->isValid()) {
            $mail->setTitle('Nouveau message de blog.local');
            $mailer = new Mailer($this->app->getConfig()->getParameter('swiftmailer'));

            if ($mailer->send($mail)) {
                $this->app->getSession()->setAttribute('flash', 'Le message à bien été envoyé.');
                $this->app->getResponse()->redirect('/contact');
            } else {
                $this->app->getSession()->setAttribute('flash', 'Erreur lors de l\'envoi du message.');
            }
        }

        return $this->render('Front/contact.html.twig', array('form' => $form->createView()));
    }

    public function executeAbout(Request $request)
    {
        return $this->render('Front/about.html.twig');
    }
}

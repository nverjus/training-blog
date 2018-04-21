<?php
namespace Blog\Controller;

use NV\MiniFram\Controller;
use NV\MiniFram\Request;
use Blog\Entity\User;
use Blog\Form\LoginFormBuilder;

class SecurityController extends Controller
{
    public function executelogin(Request $request)
    {
        if ($this->app->getSession()->isAuthentified()) {
            $this->app->getResponse()->redirect('/');
        }
        $user = new User(array());

        if ($request->getMethod() == 'POST') {
            $user->setUsername($request->postData('username'));
        }

        $builder = new LoginFormBuilder($user);
        $builder->build();
        $form = $builder->getForm();

        if ($request->getMethod() == 'POST' && $form->isValid()) {
            $credential = $this->app->getConfig()->getParameter('security');
            $user->setPassword($request->postData('password'));

            if (($user->getUsername() == $credential['username']) && password_verify($user->getPassword(), $credential['password'])) {
                $this->app->getSession()->setAttribute('auth', true);
                $this->app->getResponse()->redirect('/admin');
            } else {
                $this->app->getSession()->setAttribute('flash', 'Identifiant où mot de passe invalide');
            }
        }

        return $this->render('Security/login.html.twig', array('form' => $form->createView()));
    }


    public function executeLogout(Request $request)
    {
        $this->app->getSession()->deleteAttribute('auth');
        $this->app->getResponse()->redirect('/');
    }
}

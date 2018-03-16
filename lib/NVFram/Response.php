<?php
namespace NVFram;

class Response extends ApplicationComponent
{
    public function redirect404()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../../src/'.$this->app->getName().'/Views');
        $twig = new \Twig_Environment($loader);
        exit($twig->render('404.html.twig'));
    }

    public function send($response)
    {
        exit($response);
    }
}

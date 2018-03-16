<?php
namespace NVFram;

class Request extends ApplicationComponent
{
    public function requestURI()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getData($var)
    {
        return isset($_GET[$var]) ? $_GET[$var] : null;
    }

    public function getExists($var)
    {
        return isset($_GET[$var]);
    }

    public function postData($var)
    {
        return isset($_POST[$var]) ? $_POST[$var] : null;
    }

    public function postExists($var)
    {
        return isset($_POST[$var]);
    }
}

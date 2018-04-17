<?php
namespace NV\MiniFram;

class Session extends ApplicationComponent
{
    public function getAttribute($attr)
    {
        return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
    }

    public function setAttribute($attr, $var)
    {
        $_SESSION[$attr] = $var;
    }

    public function hasFlash()
    {
        return isset($_SESSION['flash']);
    }

    public function getFlash()
    {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }

    public function setFlash($var)
    {
        $_SESSION['flash'] = $var;
    }
}

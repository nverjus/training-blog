<?php
namespace NV\MiniFram;

class Session extends ApplicationComponent
{
    public function getAttribute($attr)
    {
        return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
    }

    public function attributeExists($attr)
    {
        return isset($_SESSION[$attr]);
    }

    public function setAttribute($attr, $var)
    {
        $_SESSION[$attr] = $var;
    }

    public function deleteAttribute($attr)
    {
        if (isset($_SESSION[$attr])) {
            unset($_SESSION[$attr]);
        }
    }

    public function isAuthentified()
    {
        if (isset($_SESSION['auth'])) {
            return $_SESSION['auth'];
        }
        return false;
    }
}

<?php
class Session
{
    public static function start()
    {
        session_start();
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function checkSession()
    {
        if (self::get("login") != true) {
            header("location: login.php");
        }
    }

    public static function checkLogin()
    {
        if (self::get("login") == true) {
            header("location: index.php");
        }
    }

    public static function destroy()
    {  
        session_unset();
        session_destroy();
        header("location: login.php");
    }
}

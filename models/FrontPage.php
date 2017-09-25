<?php

class FrontPage
{
    public static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    public static function checkLastName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    public static function checkPswd($pswd)
    {
        if (strlen($pswd) >= 6) {
            return true;
        }
        return false;
    }

    public static function checkPswd2($pswd, $pswd2)
    {
        if (!strcmp($pswd, $pswd2)) {
            return true;
        }
        return false;
    }

    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
}
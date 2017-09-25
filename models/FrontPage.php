<?php
require_once(ROOT . '/components/Db.php');

class FrontPage
{
    public static function register($name, $lastName, $email, $password)
    {

        $db = Db::getConnection();

        $sql = 'INSERT INTO users (name,lastName,email,password) '
            . 'VALUES (:name,:lastname,:email,:password)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':lastname', $lastName, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

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

    public static function checkEmailExists($email)
    {

        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn())
            return true;
        return false;
    }
}
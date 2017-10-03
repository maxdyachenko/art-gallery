<?php
require_once(ROOT . '/components/Db.php');

class FrontPage
{
    public static function auth($id) {
        $_SESSION['id'] = $id;
    }

    public static function checkCredentials($email, $password) {
        $db = Db::getConnection();

        $sql = 'SELECT id, password, name FROM USERS'
            .' WHERE email = :email';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':email' => $email));
        $row = $stmt->fetch(PDO::FETCH_LAZY);
        $isEqualPswd = password_verify($password , $row->password);
        if (!$isEqualPswd){
            return false;
        }

        self::setUserName($row->name);

        return $row->id;
    }

    private static function setUserName($name){
        $_SESSION['username'] = $name;
    }

    public static function isVerified($email) {
        $db = Db::getConnection();

        $sql = 'SELECT isverified FROM USERS'
            .' WHERE email = :email';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':email' => $email));
        return $stmt->fetchColumn();
    }

    public static function finalRegister($code)
    {

        $db = Db::getConnection();

        $sql = 'UPDATE users SET isverified = 1 '
            . 'WHERE code = :code';

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':code', $code, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public static function primaryRegister($name, $lastName, $email, $password, $code)
    {

        $db = Db::getConnection();

        $sql = 'INSERT INTO users (name,lastName,email,password,code) '
            . 'VALUES (:name,:lastname,:email,:password,:code)';

        $result = $db->prepare($sql);

        $result->execute(array(':name' => $name, ':lastname' => $lastName, ':email' => $email, ':password' => $password, ':code' => $code));
    }

    public static function checkEmailLink($name, $code) {
        $db = Db::getConnection();
        $sql = 'SELECT isverified FROM users '
            .'WHERE (code = :code AND name = :name)';
        $stmt = $db->prepare($sql);
        print_r($stmt->fetchColumn());
        $stmt->execute(array(':code' => $code, ':name' => $name));
        return $stmt->fetchColumn();
    }

    public static function checkName($name)
    {
        if (strlen($name) >= 2 && strlen($name) <= 16) {
            return true;
        }
        return false;
    }


    public static function checkPswd($pswd)
    {
        if (strlen($pswd) >= 6 && strlen($pswd) <= 16) {
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
<?php

class BaseModel
{
    public static function isLogged() {
        if (isset($_SESSION['id'])) {
            return $_SESSION['id'];
        }
        else if (isset($_COOKIE['id']) && isset($_COOKIE['token'])){
            $row = self::checkToken($_COOKIE['id'], $_COOKIE['token']);
            if ($row){
                $_SESSION['id'] = $_COOKIE['id'];
                $_SESSION['username'] = $row;
                return $_COOKIE['id'];
            }
        }
        return false;
    }

    public static function checkToken($id, $token){
        $db = Db::getConnection();
        $sql = 'SELECT name FROM users'
            .' WHERE id = :id AND remember_token = :token';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':id' => $id, ':token' => $token));
        return $stmt->fetchColumn();
    }

    public static function logOut(){
        unset($_SESSION['id'], $_SESSION['username']);
        setcookie("id", "", time()-3600);
        setcookie("token", "", time()-3600);
    }

}
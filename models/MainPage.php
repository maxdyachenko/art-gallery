<?php
require_once(ROOT . '/components/Db.php');
class MainPage
{
    public static function isLogged()
    {
        if (isset($_SESSION['id'])) {
            return $_SESSION['id'];
        }
        return false;
    }

    public static function getUserContent()
    {
        $db = Db::getConnection();

        $id = $_SESSION['id'];

        $sql = 'SELECT user_img FROM  USERS_IMGS'
            . ' WHERE user_id = :user_id';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':user_id' => $id));

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
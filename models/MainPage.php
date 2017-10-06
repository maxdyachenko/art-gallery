<?php
require_once(ROOT . '/components/Db.php');
class MainPage{

    const ITEMS_ON_PAGE = 5;

    public static function isLogged()
    {
        if (isset($_SESSION['id'])) {
            return $_SESSION['id'];
        }
        return false;
    }

    public static function setImageName($imageName) {
        $db = Db::getConnection();

        $id = $_SESSION['id'];
        $sql = 'INSERT INTO users_imgs (user_id, user_img)'
            .' VALUES (:id, :imageName)';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':id' => $id, ':imageName' => $imageName));
    }

    public static function deleteImage($imageName) {
        $db = Db::getConnection();

        $id = $_SESSION['id'];
        $sql = 'DELETE FROM users_imgs WHERE user_id = :id AND user_img = :imageName';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':id' => $id, ':imageName' => $imageName));
    }


    public static function getUserContent($page)
    {
        $db = Db::getConnection();

        $count = self::ITEMS_ON_PAGE;

        $id = $_SESSION['id'];

        $ofset = ($page - 1) * $count;

        $sql = 'SELECT user_img FROM  users_imgs'
            . ' WHERE user_id = :user_id'
            . ' LIMIT '. $count
            . ' OFFSET '. $ofset;
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':user_id' => $id));

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function getAllContent()
    {
        $db = Db::getConnection();

        $id = $_SESSION['id'];

        $sql = 'SELECT count(user_img) FROM  users_imgs'
            . ' WHERE user_id = :user_id';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':user_id' => $id));

        return $stmt->fetchColumn();
    }
}
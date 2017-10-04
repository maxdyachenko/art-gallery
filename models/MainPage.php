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

    public static function getUserContent()
    {
        $db = Db::getConnection();

        $id = $_SESSION['id'];

        $sql = 'SELECT user_img FROM  users_imgs'
            . ' WHERE user_id = :user_id';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':user_id' => $id));

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
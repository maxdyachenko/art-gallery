<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 14.10.2017
 * Time: 13:20
 */

class GalleryPage
{
    const ITEMS_ON_PAGE = 5;

    public static function getAllContent($gallery)
    {
        $db = Db::getConnection();
        $sql = 'SELECT count(user_img) FROM  users_imgs'
            . ' WHERE user_id = :user_id AND gallery_name = :gallery';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':user_id' => $_SESSION['id'], 'gallery' => $gallery));

        return $stmt->fetchColumn();
    }

    public static function getUserContent($page, $gallery)
    {
        $db = Db::getConnection();
        $count = self::ITEMS_ON_PAGE;

        $ofset = ($page - 1) * $count;

        $sql = 'SELECT user_img FROM  users_imgs'
            . ' WHERE user_id = :user_id AND gallery_name = :gallery'
            . ' ORDER BY id DESC'
            . ' LIMIT '. $count
            . ' OFFSET '. $ofset;
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':user_id' => $_SESSION['id'], 'gallery' => $gallery));

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

}
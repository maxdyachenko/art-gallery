<?php

class GalleryPage
{
    const ITEMS_ON_PAGE = 5;

    public static function checkGalleryExist($gallery){
        $db = Db::getConnection();
        $sql = 'SELECT id FROM gallerys_list'
            .' WHERE name = :gallery';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':gallery' => $gallery));
        return $stmt->fetchColumn();
    }

    public static function getUserAvatar(){
        $db = Db::getConnection();
        $sql = 'SELECT avatar FROM users'
            .' WHERE id = :id';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':id' => $_SESSION['id']));
        return $stmt->fetchColumn();
    }

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

    public static function uploadImage($gallery, $imageName) {
        $db = Db::getConnection();
        $sql = 'INSERT INTO users_imgs (gallery_name, user_id, user_img)'
            .' VALUES (:name, :id, :imageName)';
        $stmt = $db->prepare($sql);
        $stmt->execute(array('name' => $gallery, ':id' => $_SESSION['id'], ':imageName' => $imageName));
    }

    public static function deleteImage($image, $gallery) {
        $db = Db::getConnection();

        $sql = 'DELETE FROM users_imgs WHERE user_id = :id AND user_img = :image AND gallery_name = :gallery';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':id' => $_SESSION['id'], ':image' => $image, ':gallery' => $gallery));
    }

    public static function getImageMistake() {
        $imgMistake = '';
        if (!getimagesize($_FILES['file']['tmp_name'])){
            $imgMistake = "Please upload an image";
        }
        else if (!preg_match('/^.*\.(jpg|JPG|png|PNG)$/',$_FILES['file']['name'])){
            $imgMistake = "Upload only PNG or JPG";
        }
        else if ($_FILES['file']['size'] > 2000000){
            $imgMistake = "Image size should be less than 2Mb";
        }
        return $imgMistake;
    }

}
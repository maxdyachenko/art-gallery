<?php

class GalleryPage
{

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function deleteAllImages($gallery){
        $sql = 'DELETE FROM users_imgs'
            . ' WHERE user_id = :id AND gallery_name = :gallery';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array('id' => $_SESSION['id'],':gallery' => $gallery));
    }

    public function checkGalleryExist($gallery){
        $sql = 'SELECT id FROM gallerys_list'
            .' WHERE name = :gallery';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':gallery' => $gallery));
        return $stmt->fetchColumn();
    }


    public function getAllContent($gallery)
    {
        $sql = 'SELECT count(user_img) FROM  users_imgs'
            . ' WHERE user_id = :user_id AND gallery_name = :gallery';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':user_id' => $_SESSION['id'], 'gallery' => $gallery));

        return $stmt->fetchColumn();
    }

    public function getUserContent($page, $gallery)
    {
        $count = BaseModel::ITEMS_ON_PAGE;

        $ofset = ($page - 1) * $count;

        $sql = 'SELECT user_img FROM  users_imgs'
            . ' WHERE user_id = :user_id AND gallery_name = :gallery'
            . ' ORDER BY id DESC'
            . ' LIMIT '. $count
            . ' OFFSET '. $ofset;
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':user_id' => $_SESSION['id'], 'gallery' => $gallery));

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function uploadImage($gallery, $imageName) {
        $sql = 'INSERT INTO users_imgs (gallery_name, user_id, user_img)'
            .' VALUES (:name, :id, :imageName)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array('name' => $gallery, ':id' => $_SESSION['id'], ':imageName' => $imageName));
    }

    public function deleteImage($image, $gallery) {
        $sql = 'DELETE FROM users_imgs WHERE user_id = :id AND user_img = :image AND gallery_name = :gallery';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':id' => $_SESSION['id'], ':image' => $image, ':gallery' => $gallery));
    }

}
<?php

class MainPage{

    public $db;
    public $id;

    const ITEMS_ON_PAGE = 5;

    public function __construct($db){
        $this->db = $db;
        $this->id = $_SESSION['id'];
    }

    public function isLogged()
    {
        if (isset($_SESSION['id'])) {
            return $_SESSION['id'];
        }
        return false;
    }

    public function uploadImage($imageName) {

        $sql = 'INSERT INTO users_imgs (user_id, user_img)'
            .' VALUES (:id, :imageName)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':id' => $this->id, ':imageName' => $imageName));
    }

    public function getImageMistake() {
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

    public function deleteImage($imageName) {

        $sql = 'DELETE FROM users_imgs WHERE user_id = :id AND user_img = :imageName';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':id' => $this->id, ':imageName' => $imageName));
    }


    public function getUserContent($page)
    {

        $count = self::ITEMS_ON_PAGE;

        $ofset = ($page - 1) * $count;

        $sql = 'SELECT user_img FROM  users_imgs'
            . ' WHERE user_id = :user_id'
            . ' ORDER BY id DESC'
            . ' LIMIT '. $count
            . ' OFFSET '. $ofset;
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':user_id' => $this->id));

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getAllContent()
    {
        $sql = 'SELECT count(user_img) FROM  users_imgs'
            . ' WHERE user_id = :user_id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':user_id' => $this->id));

        return $stmt->fetchColumn();
    }
}
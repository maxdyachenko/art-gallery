<?php

class GalleryPage
{
    public static function getContent() {
        $db = Db::getConnection();
        $sql = 'SELECT name, avatar'
            . ' FROM gallerys_list'
            . ' WHERE user_id = :id';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':id' => $_SESSION['id']));
        return $stmt->fetchAll();
    }

    public static function hasLimit(){
        $db = Db::getConnection();
        $sql = 'SELECT COUNT(*)'
            . ' FROM gallerys_list'
            . ' WHERE user_id = :id';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':id' => $_SESSION['id']));
        return $stmt->fetchColumn();
    }

    public static function checkGalleryName($name){
        $db = Db::getConnection();
        $sql = 'SELECT id'
            . ' FROM gallerys_list'
            . ' WHERE user_id = :id AND name = :name';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':id' => $_SESSION['id'], 'name' => $name));
        return $stmt->fetchColumn();
    }

    public static function uploadGallery($image, $name){
        $db = Db::getConnection();
        $sql = 'INSERT INTO gallerys_list (name, avatar, user_id)'
            .' VALUES (:name, :image, :id)';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':id' => $_SESSION['id'], ':image' => $image, 'name' => $name));
    }
}
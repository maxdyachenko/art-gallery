<?php

class GalleryListPage
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getContent() {
        $sql = 'SELECT name, avatar'
            . ' FROM gallerys_list'
            . ' WHERE user_id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':id' => $_SESSION['id']));
        return $stmt->fetchAll();
    }

    public function hasLimit(){
        $sql = 'SELECT COUNT(*)'
            . ' FROM gallerys_list'
            . ' WHERE user_id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':id' => $_SESSION['id']));
        return $stmt->fetchColumn();
    }

    public function checkGalleryName($name){
        $sql = 'SELECT id'
            . ' FROM gallerys_list'
            . ' WHERE user_id = :id AND name = :name';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':id' => $_SESSION['id'], 'name' => $name));
        return $stmt->fetchColumn();
    }

    public function uploadGallery($image, $name){
        $sql = 'INSERT INTO gallerys_list (name, avatar, user_id)'
            .' VALUES (:name, :image, :id)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':id' => $_SESSION['id'], ':image' => $image, 'name' => $name));
    }

    public function deleteGallery($name){
        $sql = 'DELETE FROM gallerys_list'
            . ' WHERE user_id = :id AND name = :name';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':id' => $_SESSION['id'], ':name' => $name));
    }
}
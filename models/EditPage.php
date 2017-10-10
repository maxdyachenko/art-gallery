<?php

class EditPage
{

    public function __construct($db)
    {
        $this->db = $db;
        $this->id = MainPage::isLogged();
    }

    public function getUserAvatar(){
        $sql = 'SELECT avatar FROM users'
            .' WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':id' => $this->id));
        return $stmt->fetchColumn();
    }
}
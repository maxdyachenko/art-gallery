<?php

class EditPage
{

    public function __construct($db)
    {
        $this->db = $db;
        $this->id = BaseModel::isLogged();
    }

    public function getUserAvatar(){
        $sql = 'SELECT avatar FROM users'
            .' WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':id' => $this->id));
        return $stmt->fetchColumn();
    }

    public function updateNames($name, $lastname){
        $sql = 'UPDATE users SET name = :name,'
            . ' lastname = :lastname '
            . 'WHERE id = :id';
        $result = $this->db->prepare($sql);

        $result->execute(array(':name' => $name, ':lastname' => $lastname, ':id' => $this->id));
        FrontPage::setUserName($name);
    }

    public function checkPswdCorrect($pswd){
        $sql = 'SELECT password FROM users'
            .' WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':id' => $this->id));
        $hash = $stmt->fetchColumn();
        return password_verify($pswd , $hash);

    }

    public function updatePswd($pswd){
        $sql = 'UPDATE users SET password = :pswd'
            . ' WHERE id = :id';
        $result = $this->db->prepare($sql);

        $result->execute(array(':pswd' => $pswd, ':id' => $this->id));
    }

    public function uploadImage($img){
        $sql = 'UPDATE users SET avatar = :avatar'
            . ' WHERE id= :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':avatar' => $img, ':id' => $this->id));
    }
}
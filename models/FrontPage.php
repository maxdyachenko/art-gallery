<?php
require_once(ROOT . '/components/Db.php');

class FrontPage{

    public function __construct(){
        $this->db = Db::getConnection();
    }

    public function auth($id) {
        $_SESSION['id'] = $id;
    }

    public function checkCredentials($email, $password) {

        $sql = 'SELECT id, password, name FROM users'
            .' WHERE email = :email';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':email' => $email));
        $row = $stmt->fetch(PDO::FETCH_LAZY);
        $isEqualPswd = password_verify($password , $row->password);
        if (!$isEqualPswd){
            return false;
        }

        $this->setUserName($row->name);

        return $row->id;
    }

    private function setUserName($name){
        $_SESSION['username'] = $name;
    }

    public function isVerified($email) {
        $this->db = Db::getConnection();

        $sql = 'SELECT isverified FROM users'
            .' WHERE email = :email';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':email' => $email));
        return $stmt->fetchColumn();
    }

    public function finalRegister($code)
    {
        $sql = 'UPDATE users SET isverified = 1 '
            . 'WHERE code = :code';

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':code', $code, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function primaryRegister($name, $lastName, $email, $password, $code)
    {
        $sql = 'INSERT INTO users (name,lastName,email,password,code) '
            . 'VALUES (:name,:lastname,:email,:password,:code)';

        $result = $this->db->prepare($sql);

        $result->execute(array(':name' => $name, ':lastname' => $lastName, ':email' => $email, ':password' => $password, ':code' => $code));
    }

    public function checkEmailLink($name, $code) {
        $sql = 'SELECT isverified FROM users '
            .'WHERE (code = :code AND name = :name)';
        $stmt = $this->db->prepare($sql);
        print_r($stmt->fetchColumn());
        $stmt->execute(array(':code' => $code, ':name' => $name));
        return $stmt->fetchColumn();
    }

    public function checkName($name)
    {
        if (strlen($name) >= 2 && strlen($name) <= 16) {
            return true;
        }
        return false;
    }


    public function checkPswd($pswd)
    {
        if (strlen($pswd) >= 6 && strlen($pswd) <= 16) {
            return true;
        }
        return false;
    }

    public function checkPswd2($pswd, $pswd2)
    {
        if (!strcmp($pswd, $pswd2)) {
            return true;
        }
        return false;
    }

    public function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function checkEmailExists($email)
    {

        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';

        $result = $this->db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn())
            return true;
        return false;
    }
}
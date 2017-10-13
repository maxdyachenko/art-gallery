<?php

class BaseModel
{
    public static function isLogged() {
        if (isset($_SESSION['id'])) {
            return $_SESSION['id'];
        }
        else if (isset($_COOKIE['id']) && isset($_COOKIE['token'])){
            $row = self::checkToken($_COOKIE['id'], $_COOKIE['token']);
            if ($row){
                $_SESSION['id'] = $_COOKIE['id'];
                $_SESSION['username'] = $row;
                return $_COOKIE['id'];
            }
        }
        return false;
    }

    public static function sendEmail($mail, $name, $code)
    {
        $to = $mail;
        $subject = "Hi, {$name} ! Please, confirm you email on Art Gallery";
        $message = '
                <html>
                    <head>
                        <title>' . $subject . '</title>
                    </head>
                    <body>
                        <p>Please, click this link to verify your email: http://online-shopping.esy.es/verify-email?username=' . $name . '&code=' . $code . '</p>                
                    </body>
                </html>';
        $headers = "Content-type: text/html; charset=utf-8 \r\n" . "From: Art Gallery <from@art-gallery.com>\r\n";
        mail($to, $subject, $message, $headers);
    }

    public static function checkToken($id, $token){
        $db = Db::getConnection();
        $sql = 'SELECT name FROM users'
            .' WHERE id = :id AND remember_token = :token';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':id' => $id, ':token' => $token));
        return $stmt->fetchColumn();
    }

    public static function saveCode($code){
        $db = Db::getConnection();
        $sql = 'UPDATE users SET code = :code'
            . ' WHERE email = :mail';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':code' => $code, ':mail' => $_SESSION['mail']));
    }

    public static function logOut(){
        unset($_SESSION['id'], $_SESSION['username']);
        setcookie("id", "", time()-3600);
        setcookie("token", "", time()-3600);
    }

}
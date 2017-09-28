<?php
require_once(ROOT . '/models/FrontPage.php');
class FrontPageController{
    private $name;
    private $lastName;
    private $mail;
    private $pswd;
    private $pswd2;
    private $code;
    public function actionIndex(){
        $this->fieldsValidate();
        return true;
    }

    public function fieldsValidate(){
        if (isset($_POST['register'])) {
            $errors = [];
            $this->name = $this->safeInput($_POST['regName']);
            $this->lastName = $this->safeInput($_POST['regLastName']);
            $this->mail = $this->safeInput($_POST['regEmail']);
            $this->pswd = $this->safeInput($_POST['regPswd']);
            $this->pswd2 = $this->safeInput($_POST['regPswd2']);

            if (!FrontPage::checkName($this->name)){
                $errors['name'] = 1;
            }
            if (!FrontPage::checkName($this->lastName)){
                $errors['lastName'] = 1;
            }
            if (!FrontPage::checkPswd($this->pswd)){
                $errors['pswd'] = 1;
            }
            if (!FrontPage::checkPswd2($this->pswd, $this->pswd2)){
                $errors['pswd2'] = 1;
            }
            if (!FrontPage::checkEmail($this->mail)){
                $errors['mail'] = 1;
            }
            if (FrontPage::checkEmailExists($this->mail)) {
                $errors['mail'] = 2; //hack to show another mistake in view file
            }

            if (empty($errors)) {
                $this->code = rand();
                $this->sendEmail();
                $hash = password_hash($this->pswd, PASSWORD_DEFAULT);
                FrontPage::primaryRegister($this->name, $this->lastName, $this->mail, $hash, $this->code);
            }
        }
        require_once(ROOT . '/views/site/index.php');//TODO make that at the actionINdex
    }

    public function sendEmail() {
        $to = $this->mail;
        $subject = "Hi, {$this->name} ! Please, confirm you email on Art Gallery";
        $message = '
                <html>
                    <head>
                        <title>'.$subject.'</title>
                    </head>
                    <body>
                        <p>Your name: '.$this->name.'</p>
                        <p>Password '.$this->pswd.'</p> 
                        <p>-------------------------</p>
                        <p>Please, click this link to verify your email: http://online-shopping.esy.es/verify-email?username='.$this->name.'&code='.$this->code.'</p>                
                    </body>
                </html>';
        $headers  = "Content-type: text/html; charset=utf-8 \r\n"."From: Art Gallery <from@art-gallery.com>\r\n";
        mail($to, $subject, $message, $headers);
    }

    public function safeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function actionRegister() {
        $username = $this->safeInput($_GET['username']);
        $code = $this->safeInput($_GET['code']);

        if (!FrontPage::checkEmailLink($username, $code)){
            FrontPage::finalRegister($code);
            echo "User registred";//TODO make relocation to main page
        }
        else {
            echo "ne zaebis";
        }

        return true;
    }
}
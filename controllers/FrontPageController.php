<?php

class FrontPageController
{
    private $name;
    private $lastName;
    private $mail;
    private $pswd;
    private $pswd2;
    private $code;

    public $errors = [];

    public function __construct(){
        $this->model = new FrontPage(Db::getConnection());
    }

    public function actionIndex()
    {
        $this->regFieldsValidate();

        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    public function actionAuth() {
        $error = null;
        if (isset($_POST['authEmail']) && isset($_POST['authPswd'])) {
            $email = FrontPage::safeInput($_POST['authEmail']);
            $pswd = FrontPage::safeInput($_POST['authPswd']);


            if (!$this->model->checkEmail($email) || !$this->model->checkEmailExists($email) || !$this->model->checkPswd($pswd)) {
                $error = "Password or email is incorrect";
            } else {
                $userId = $this->model->checkCredentials($email, $pswd);
                if (!$userId) {
                    $error = "Password or email is incorrect";
                } else if ($this->model->isVerified($email)){
                    $this->model->auth($userId);
                    $error = "No errors";
                } else{
                    $error = "Email is not verified";
                }
            }
        }
        echo $error;
        return true;
    }

    public function regFieldsValidate()
    {
        if (isset($_POST['register'])) {
            $this->name = FrontPage::safeInput($_POST['regName']);
            $this->lastName = FrontPage::safeInput($_POST['regLastName']);
            $this->mail = FrontPage::safeInput($_POST['regEmail']);
            $this->pswd = FrontPage::safeInput($_POST['regPswd']);
            $this->pswd2 = FrontPage::safeInput($_POST['regPswd2']);

            if (!FrontPage::checkName($this->name)) {
                $this->errors['name'] = 1;
            }
            if (!FrontPage::checkName($this->lastName)) {
                $this->errors['lastName'] = 1;
            }
            if (!FrontPage::checkPswd($this->pswd)) {
                $this->errors['pswd'] = 1;
            }
            if (!$this->model->checkPswd2($this->pswd, $this->pswd2)) {
                $this->errors['pswd2'] = 1;
            }
            if (!$this->model->checkEmail($this->mail)) {
                $this->errors['mail'] = 1;
            }
            if ($this->model->checkEmailExists($this->mail)) {
                $this->errors['mail'] = 2; //hack to show another mistake in view file
            }

            if (empty($this->errors)) {
                $bytes = random_bytes(10);
                $this->code = bin2hex($bytes);
                $this->sendEmail();
                $hash = password_hash($this->pswd, PASSWORD_DEFAULT);
                $this->model->primaryRegister($this->name, $this->lastName, $this->mail, $hash, $this->code);
                header('Location: /', false, 303);
            }
        }
    }

    public function sendEmail()
    {
        $to = $this->mail;
        $subject = "Hi, {$this->name} ! Please, confirm you email on Art Gallery";
        $message = '
                <html>
                    <head>
                        <title>' . $subject . '</title>
                    </head>
                    <body>
                        <p>Your name: ' . $this->name . '</p>
                        <p>Password ' . $this->pswd . '</p> 
                        <p>-------------------------</p>
                        <p>Please, click this link to verify your email: http://online-shopping.esy.es/verify-email?username=' . $this->name . '&code=' . $this->code . '</p>                
                    </body>
                </html>';
        $headers = "Content-type: text/html; charset=utf-8 \r\n" . "From: Art Gallery <from@art-gallery.com>\r\n";
        mail($to, $subject, $message, $headers);
    }


    public function actionRegister()
    {
        $username = FrontPage::safeInput($_GET['username']);
        $code = FrontPage::safeInput($_GET['code']);

        if (!$this->model->checkEmailLink($username, $code)) {
            $this->model->finalRegister($code);
            require_once(ROOT . '/views/layouts/email-confirmed.php');
            header("refresh:5; url=/");
        } else {
            header("refresh:5; url=/");
        }

        return true;
    }

}
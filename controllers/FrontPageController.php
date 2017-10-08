<?php
require_once(ROOT . '/models/FrontPage.php');

class FrontPageController
{
    private $name;
    private $lastName;
    private $mail;
    private $pswd;
    private $pswd2;
    private $code;

    public $errors = [];
    public $authError;
    public $notVerified = false;

    public function __construct(){
        $this->model = new FrontPage();
    }

    public function actionIndex()
    {
        $this->authFieldsValidate();
        $this->regFieldsValidate();

        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    public function authFieldsValidate()
    {
        if (isset($_POST['auth'])) {
            $this->authError = false;
            $email = $this->safeInput($_POST['authEmail']);
            $pswd = $this->safeInput($_POST['authPswd']);


            if (!$this->model->checkEmail($email) || !$this->model->checkEmailExists($email) || !$this->model->checkPswd($pswd)) {
                $this->authError = true;
            } else {
                $userId = $this->model->checkCredentials($email, $pswd);
                if (!$userId) {
                    $this->authError = true;
                } else if ($this->model->isVerified($email)){
                    $this->model->auth($userId);
                    header('Location: /main');
                } else{
                    $this->notVerified = true;
                }
            }
        }
    }

    public function regFieldsValidate()
    {
        if (isset($_POST['register'])) {
            $this->name = $this->safeInput($_POST['regName']);
            $this->lastName = $this->safeInput($_POST['regLastName']);
            $this->mail = $this->safeInput($_POST['regEmail']);
            $this->pswd = $this->safeInput($_POST['regPswd']);
            $this->pswd2 = $this->safeInput($_POST['regPswd2']);

            if (!$this->model->checkName($this->name)) {
                $this->errors['name'] = 1;
            }
            if (!$this->model->checkName($this->lastName)) {
                $this->errors['lastName'] = 1;
            }
            if (!$this->model->checkPswd($this->pswd)) {
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

    public function safeInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function actionRegister()
    {
        $username = $this->safeInput($_GET['username']);
        $code = $this->safeInput($_GET['code']);

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
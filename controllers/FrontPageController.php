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
        if (BaseModel::isLogged()) {
            header('Location: /gallery-list');
            exit;
        }
        $this->model = new FrontPage(Db::getConnection());
    }

    public function actionIndex()
    {
        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    public function actionAuth() {
        $error = null;
        if (isset($_POST['authEmail']) && isset($_POST['authPswd'])) {
            $email = BaseModel::safeInput($_POST['authEmail']);
            $pswd = BaseModel::safeInput($_POST['authPswd']);


            if (!$this->model->checkEmail($email) || !$this->model->checkEmailExists($email) || !FrontPage::checkPswd($pswd)) {
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

            if ($error == "No errors" && !$this->model->hasToken($email) && isset($_POST['rememberMe'])){
                $bytes = random_bytes(20);
                $token = bin2hex($bytes);
                $this->model->setToken($token);
            }
            else if ($this->model->hasToken($email) && $error == "No errors" && isset($_POST['rememberMe'])){ //method to remember user on different browsers
                $this->model->setTokenInCookie($_SESSION['id'], $this->model->hasToken($email));
            }
        }
        echo $error;
        return true;
    }

    public function actionRegisterPrimary()
    {
        if (isset($_POST['regEmail']) && isset($_POST['regPswd']) && isset($_POST['regPswd2']) && isset($_POST['regName']) && isset($_POST['regLastName'])) {
            $this->name = BaseModel::safeInput($_POST['regName']);
            $this->lastName = BaseModel::safeInput($_POST['regLastName']);
            $this->mail = BaseModel::safeInput($_POST['regEmail']);
            $this->pswd = BaseModel::safeInput($_POST['regPswd']);
            $this->pswd2 = BaseModel::safeInput($_POST['regPswd2']);

            if (!BaseModel::checkName($this->name)) {
                $this->errors['name'] = "Min 2 chars max 16 chars";
            }
            if (!BaseModel::checkName($this->lastName)) {
                $this->errors['lastName'] = "Min 2 chars max 16 chars";
            }
            if (!BaseModel::checkPswd($this->pswd)) {
                $this->errors['pswd'] = "Min 6 chars max 16 chars";
            }
            if (!$this->model->checkPswd2($this->pswd, $this->pswd2)) {
                $this->errors['pswd2'] = "Passwords do not match";
            }
            if (!$this->model->checkEmail($this->mail)) {
                $this->errors['mail'] = "Invalid email";
            }
            if ($this->model->checkEmailExists($this->mail)) {
                $this->errors['mail'] = "Such email already exists";
            }

            if (empty($this->errors)) {
                $this->model->saveUserInfo($this->name, $this->mail);
                $bytes = random_bytes(10);
                $this->code = bin2hex($bytes);
                BaseModel::sendEmail($this->mail, $this->name, $this->code);
                $hash = password_hash($this->pswd, PASSWORD_DEFAULT);
                $this->model->primaryRegister($this->name, $this->lastName, $this->mail, $hash);
                BaseModel::saveCode($this->code);
            }
            else {
                echo json_encode($this->errors);
            }
        }
        return true;
    }



    public function actionRegister()
    {
        $username = BaseModel::safeInput($_GET['username']);
        $code = BaseModel::safeInput($_GET['code']);

        if (!$this->model->checkEmailLink($username, $code)) {
            $this->model->finalRegister($code);
            $this->model->resetUserInfo();
            require_once(ROOT . '/views/layouts/email-confirmed.php');
            header("refresh:5; url=/");
        } else {
            header("refresh:5; url=/");
        }

        return true;
    }

}
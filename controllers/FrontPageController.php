<?php
require_once(ROOT . '/models/FrontPage.php');
class FrontPageController{
    public function actionIndex(){
        $this->actionRegister();
    }

    public function actionRegister(){
        if (isset($_POST['register'])) {
            $errors = [];
            $name = $_POST['regName'];
            $lastName = $_POST['regLastName'];
            $mail = $_POST['regEmail'];
            $pswd = $_POST['regPswd'];
            $pswd2 = $_POST['regPswd2'];

            if (!FrontPage::checkName($name)){
                $errors['name'] = true;
            }
            if (!FrontPage::checkLastName($lastName)){
                $errors['lastName'] = true;
            }
            if (!FrontPage::checkPswd($pswd)){
                $errors['pswd'] = true;
            }
            if (!FrontPage::checkPswd2($pswd, $pswd2)){
                $errors['pswd2'] = true;
            }
            if (!FrontPage::checkEmail($mail)){
                $errors['mail'] = true;
            }
        }
        require_once(ROOT . '/views/site/index.php');
    }
}
<?php
#TODO make safe registration
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
                $errors['name'] = "Name should include at least 2 charachters";
            }
            if (!FrontPage::checkLastName($lastName)){
                $errors['lastName'] = "Last Name should include at least 2 charachters";
            }
            if (!FrontPage::checkPswd($pswd)){
                $errors['pswd'] = "Password should include at least 6 charachters";
            }
            if (!FrontPage::checkPswd2($pswd, $pswd2)){
                $errors['pswd2'] = "Passwords do not match";
            }
            if (!FrontPage::checkEmail($mail)){
                $errors['mail'] = "Incorrect mail";
            }
            if (FrontPage::checkEmailExists($mail)) {
                $errors['mail'] = "Mail already used";
            }

            if (empty($errors)) {
                FrontPage::register($name, $lastName, $mail, $pswd);
            }
        }
        require_once(ROOT . '/views/site/index.php');
    }
}
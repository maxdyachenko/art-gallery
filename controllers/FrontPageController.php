<?php
require_once(ROOT . '/models/FrontPage.php');
class FrontPageController{
    public function actionIndex(){
        $this->actionRegister();
    }

    public function actionRegister(){
        if (isset($_POST['register'])) {
            $errors = [];
            $name = $this->safeInput($_POST['regName']);
            $lastName = $this->safeInput($_POST['regLastName']);
            $mail = $this->safeInput($_POST['regEmail']);
            $pswd = $this->safeInput($_POST['regPswd']);
            $pswd2 = $this->safeInput($_POST['regPswd2']);

            if (!FrontPage::checkName($name)){
                $errors['name'] = "Name should include at least 2 charachters";
            }
            if (!FrontPage::checkLastName($lastName)){
                $errors['lastName'] = "Last Name should include at least 2 charachters";
            }
            if (!FrontPage::checkPswd($pswd)){
                $errors['pswd'] = 1;
            }
            if (!FrontPage::checkPswd2($pswd, $pswd2)){
                $errors['pswd2'] = "Passwords do not match";
            }
            if (!FrontPage::checkEmail($mail)){
                $errors['mail'] = 1;
            }
            if (FrontPage::checkEmailExists($mail)) {
                $errors['mail'] = 2; //hack to show another mistake in view file
            }

            if (empty($errors)) {
                FrontPage::register($name, $lastName, $mail, $pswd);
            }
        }
        require_once(ROOT . '/views/site/index.php');
    }

    public function safeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
<?php

class ActivatePageController
{
    public function actionActivateEmail(){
        $bytes = random_bytes(10);
        $code = bin2hex($bytes);
        if (BaseModel::isLogged()) {
            die('Access denied');
        }
        if ($_SESSION['resends'] > 0) {
            $_SESSION['resends'] -= 1;
            BaseModel::sendEmail($_SESSION['mail'], $_SESSION['name'], $code);
            BaseModel::saveCode($code);
        }
        require_once(ROOT . '/views/layouts/activate-email.php');
        return true;
    }
}
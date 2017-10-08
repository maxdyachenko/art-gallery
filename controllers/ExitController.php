<?php
class ExitController{
    public function actionExit(){
        unset($_SESSION['id'], $_SESSION['username']);
        header('Location: /');
        return true;
    }
}
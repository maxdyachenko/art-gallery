<?php
require_once(ROOT . '/models/ExitModel.php');
class ExitController{
    public function actionExit(){
        ExitModel::logOut();
        header('Location: /');
        return true;
    }
}
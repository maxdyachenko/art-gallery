<?php
class ExitController{
    public function actionExit(){
        BaseModel::logOut();
        header('Location: /');
        return true;
    }
}
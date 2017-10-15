<?php

class GalleryListPageController
{
    public $current = "Gallery list";

    public function __construct(){
        if (!BaseModel::isLogged()) {
            header('Location: /');
            exit;
        }
        $this->model = new GalleryListPage(Db::getConnection());

        $this->userAvatar = BaseModel::getUserAvatar();
    }

    public function actionIndex(){

        require_once(ROOT . '/views/site/gallery-list.php');
        return true;
    }

    public function getContent(){
        return $this->model->getContent();
    }
}
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

    public function actionDeleteGallery(){
        if (isset($_POST['name'])) {
            $gallery = BaseModel::safeInput($_POST['name']);

            BaseModel::deleteAllImages($gallery);
            $this->model->deleteGallery($gallery);

            $files = glob("{$_SERVER['DOCUMENT_ROOT']}/assets/img/gallerys/{$_SESSION['id']}/{$gallery}/*");
            foreach($files as $file){
                if(is_file($file)){
                    unlink($file);
                }
            }

        }
        header('Location: /gallery-list');
        return true;
    }
}
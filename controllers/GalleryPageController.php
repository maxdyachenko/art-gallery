<?php

class GalleryPageController
{
    public $userAvatar;

    public $currentPage = 1;
    public $gallery;
    public $imgMistake;

    public function __construct(){
        if (!BaseModel::isLogged()) {
            header('Location: /');
            exit;
        }

        $this->userAvatar = BaseModel::getUserAvatar();
        $this->model = new GalleryPage(Db::getConnection());
    }

    public function actionIndex($gallery, $page = 1){

        if (!$this->model->checkGalleryExist($gallery)){
            header('Location: /gallery-list');
            exit;
        }

        $this->currentPage = $page;
        $this->gallery = $gallery;

        $totalOfContent = $this->model->getAllContent($gallery);

        $pagination = new Pagination($totalOfContent, $this->currentPage, BaseModel::ITEMS_ON_PAGE, $gallery);

        if ($page > $pagination->amount)
            header('Location: /gallery/' . $gallery . '/1');

        require_once(ROOT . '/views/site/gallery.php');
        return true;
    }
    public function updateContent(){
        $userContent = $this->model->getUserContent($this->currentPage, $this->gallery);

        $html = include_once ROOT . '/views/layouts/add-image-block.php';
        foreach($userContent as $key=>$value) {
            $temp = include ROOT . '/views/layouts/image-block.php';
            $html = $html . $temp;
        }
        return $html;
    }

    public function actionImageUpload($gallery) {
        $dirName = "{$_SERVER['DOCUMENT_ROOT']}/assets/img/gallerys/{$_SESSION['id']}/{$gallery}/";
        !file_exists($dirName) ? mkdir($dirName, 0755, true) : false;
        if (isset($_POST['upload-image'])){
            $this->imgMistake = BaseModel::getImageMistake();
            if (!$this->imgMistake) {
                $temp = explode(".", $_FILES['file']['name']);
                $newfilename = round(microtime(true)) . '.' . end($temp);
                move_uploaded_file($_FILES['file']['tmp_name'], $dirName . $newfilename);
                $this->model->uploadImage($gallery, $newfilename);
                header('Location: /gallery/' . $gallery);
            }
        }
        header('Location: /gallery/' . $gallery);
        return true;
    }

    public function actionDelete(){
        if (isset($_POST['name']) && isset($_POST['gallery'])){

            $this->model->deleteImage($_POST['name'], $_POST['gallery']);
            unlink("{$_SERVER['DOCUMENT_ROOT']}/assets/img/gallerys/{$_SESSION['id']}/{$_POST['gallery']}/{$_POST['name']}");
        }
        header('Location: /gallery/' . $_POST['gallery']);
        return true;
    }

    public function actionDeleteAll($gallery){
        $files = glob("{$_SERVER['DOCUMENT_ROOT']}/assets/img/gallerys/{$_SESSION['id']}/{$gallery}/*");
        foreach($files as $file){
            $str = explode('/', $file);
            if(is_file($file) && strpos(end($str), 'gallery-avatar') === false){
                unlink($file);
            }
        }
        BaseModel::deleteAllImages($gallery);
        header('Location: /gallery/' . $gallery);
        return true;
    }


}
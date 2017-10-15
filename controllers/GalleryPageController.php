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

        $this->userAvatar = GalleryPage::getUserAvatar();
    }

    public function actionIndex($gallery, $page = 1){

        if (!GalleryPage::checkGalleryExist($gallery)){
            header('Location: /gallery-list');
            exit;
        }

        $this->currentPage = $page;
        $this->gallery = $gallery;

        $totalOfContent = GalleryPage::getAllContent($gallery);

        $pagination = new Pagination($totalOfContent, $this->currentPage, GalleryPage::ITEMS_ON_PAGE, $gallery);

        if ($page > $pagination->amount)
            header('Location: /gallery/' . $gallery . '/1');

        require_once(ROOT . '/views/site/gallery.php');
        return true;
    }
    public function updateContent(){
        $userContent = GalleryPage::getUserContent($this->currentPage, $this->gallery);

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
            $this->imgMistake = GalleryPage::getImageMistake();
            if (!$this->imgMistake) {
                $temp = explode(".", $_FILES['file']['name']);
                $newfilename = round(microtime(true)) . '.' . end($temp);
                move_uploaded_file($_FILES['file']['tmp_name'], $dirName . $newfilename);
                GalleryPage::uploadImage($gallery, $newfilename);
                header('Location: /gallery/' . $gallery);
            }
        }
        header('Location: /gallery/' . $gallery);
        return true;
    }

    public function actionDelete(){
        if (isset($_POST['name']) && isset($_POST['gallery'])){

            GalleryPage::deleteImage($_POST['name'], $_POST['gallery']);
            unlink("{$_SERVER['DOCUMENT_ROOT']}/assets/img/gallerys/{$_SESSION['id']}/{$_POST['gallery']}/{$_POST['name']}");
        }
        header('Location: /gallery/' . $_POST['gallery']);
        return true;
    }


}
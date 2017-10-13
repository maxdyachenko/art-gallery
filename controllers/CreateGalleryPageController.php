<?php

class CreateGalleryPageController
{
    public $errors = [];
    public function actionIndex(){
        require_once(ROOT . '/views/site/create-gallery.php');
        return true;
    }

    public function actionCreateGallery(){
        if (GalleryPage::hasLimit() < 6){
            $this->errors['limit'] = "You cant create more than 5 galleries";
            header('Location: /create-gallery');
        }
        if (isset($_POST['submit'])){
            $name = FrontPage::safeInput($_POST['galleryName']);
            if (GalleryPage::checkGalleryName($name)){
                $this->errors['name'] = "Gallery with such name already exists";
                header('Location: /create-gallery');
            }
            else if (empty($name)){
                $this->errors['name'] = "Invalid name";
                header('Location: /create-gallery');
            }
            $dirName = "{$_SERVER['DOCUMENT_ROOT']}/assets/img/gallerys/{$_SESSION['id']}/{$name}/";
            !file_exists($dirName) ? mkdir($dirName, 0777, true) : false;
            $this->errors['img'] = MainPage::getImageMistake();
            if (!$this->errors['img']) {
                $temp = explode(".", $_FILES['file']['name']);
                $newfilename = 'gallery-avatar.' . end($temp);
                move_uploaded_file($_FILES['file']['tmp_name'], $dirName . $newfilename);
                GalleryPage::uploadGallery($_FILES['file']['name'], $name);
                header('Location: /gallery-list');
            }
        }
        header('Location: /create-gallery');
        return true;
    }

}
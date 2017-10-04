<?php
require_once(ROOT . '/models/MainPage.php');
class MainPageController{

    public $imgMistake = null;

    public function actionContent() {
        if (!MainPage::isLogged())
            header('Location: /');

        $userContent = MainPage::getUserContent();


        $this->imageUpload();
        require_once(ROOT . '/views/site/news.php');

        return true;
    }

    public function actionDelete(){
        if (isset($_POST['imgName'])){
            MainPage::deleteImage($_POST['imgName']);
            unlink("{$_SERVER['DOCUMENT_ROOT']}/assets/img/{$_SESSION['id']}/{$_POST['imgName']}");
            $this->updateContent();
        }
        return true;
    }

    public function updateContent(){
        $userContent = MainPage::getUserContent();

        $html = include_once ROOT . '/views/layouts/add-image-block.php';
        foreach($userContent as $key=>$value) {
            $temp = include ROOT . '/views/layouts/image-block.php';
            $html = $html . $temp;
        }
        return $html;
    }

    public function imageUpload() {
        $dirName = "{$_SERVER['DOCUMENT_ROOT']}/assets/img/{$_SESSION['id']}/";
        !file_exists($dirName) ? mkdir($dirName, 0755) : false;
        if (isset($_POST['upload-image'])){
            if ($this->validateImage()) {
                $temp = explode(".", $_FILES['file']['name']);
                $newfilename = round(microtime(true)) . '.' . end($temp);
                move_uploaded_file($_FILES['file']['tmp_name'], $dirName . $newfilename);
                MainPage::setImageName($newfilename);
                header('Location: /main');
            }
        }
    }

    public function validateImage() {
        if (!getimagesize($_FILES['file']['tmp_name'])){
            $this->imgMistake = "Please upload an image";
            return false;
        }
        else if (!preg_match('/^.*\.(jpg|JPG|png|PNG)$/',$_FILES['file']['name'])){
            $this->imgMistake = "Upload only PNG or JPG";
            return false;
        }
        else if ($_FILES['file']['size'] > 2000000){
            $this->imgMistake = "Image size should be less than 2Mb";
            return false;
        }
        return true;
    }

}
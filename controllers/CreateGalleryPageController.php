<?php

class CreateGalleryPageController
{
    public $errors = [];

    public function __construct()
    {

        if (!BaseModel::isLogged()) {
            header('Location: /');
            exit;
        }
        $this->userAvatar = BaseModel::getUserAvatar();
        $this->model = new GalleryListPage(Db::getConnection());
    }

    public function actionIndex(){
        require_once(ROOT . '/views/site/create-gallery.php');
        return true;
    }

    public function actionCreateGallery(){
        if ($this->model->hasLimit() > 4){
            $this->errors['limit'] = "You cant create more than 5 galleries";
            print_r(json_encode($this->errors));
            exit;
        }
        if (isset($_POST['name'])){
            $name = BaseModel::safeInput($_POST['name']);
            $name = str_replace(" ", "_", $name);
            if ($this->model->checkGalleryName($name)){
                $this->errors['name'] = "Gallery with such name already exists";
            }
            else if (empty($name)){
                $this->errors['name'] = "Invalid name";
            }
            else {
                $dirName = "{$_SERVER['DOCUMENT_ROOT']}/assets/img/gallerys/{$_SESSION['id']}/{$name}/";
                !file_exists($dirName) ? mkdir($dirName, 0777, true) : false;
                BaseModel::getImageMistake() ? $this->errors['img'] : false;
                if (!isset($this->errors['img'])) {
                    $temp = explode(".", $_FILES['file']['name']);
                    $newfilename = 'gallery-avatar.' . end($temp);
                    move_uploaded_file($_FILES['file']['tmp_name'], $dirName . $newfilename);
                    $this->model->uploadGallery($_FILES['file']['name'], $name);
                }
            }
        }
        print_r(json_encode($this->errors));
        return true;
    }

}
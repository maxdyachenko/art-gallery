<?php
require_once(ROOT . '/models/MainPage.php');
require_once(ROOT . '/components/Pagination.php');
require_once(ROOT . '/models/Avatar.php');
class MainPageController{

    public $imgMistake = null;
    public $current = 'Home';
    public $currentPage = 1;

    public function __construct(){
        $this->model = new MainPage();
    }


    public function actionContent($page = 1) {
        if (!$this->model->isLogged())
            header('Location: /');

        $this->currentPage = $page;

        $userContent = $this->model->getUserContent($this->currentPage);
        $totalOfContent = $this->model->getAllContent();

        $pagination = new Pagination($totalOfContent, $this->currentPage, MainPage::ITEMS_ON_PAGE);

        if ($page > $pagination->amount)
            header('Location: /main/1');

        $this->imageUpload();
        require_once(ROOT . '/views/site/news.php');

        return true;
    }

    public function actionDelete(){
        if (isset($_POST['name'])){
            $this->model->deleteImage($_POST['name']);
            unlink("{$_SERVER['DOCUMENT_ROOT']}/assets/img/{$_SESSION['id']}/{$_POST['name']}");
        }
        header('Location: /main/' . $this->currentPage);
        return true;
    }

    public function updateContent(){
        $userContent = $this->model->getUserContent($this->currentPage);

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
            $this->imgMistake = $this->model->getImageMistake();
            if (!$this->imgMistake) {
                $temp = explode(".", $_FILES['file']['name']);
                $newfilename = round(microtime(true)) . '.' . end($temp);
                move_uploaded_file($_FILES['file']['tmp_name'], $dirName . $newfilename);
                $this->model->uploadImage($newfilename);
                header('Location: /main');
            }
        }
    }

}
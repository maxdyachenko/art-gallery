<?php

class GalleryPageController
{
    public $currentPage = 1;
    public $gallery;

    public function __construct(){
        if (!BaseModel::isLogged()) {
            header('Location: /');
            exit;
        }
    }

    public function actionIndex($gallery, $page = 1){
        $this->currentPage = $page;
        $this->gallery = $gallery;

        $totalOfContent = GalleryPage::getAllContent($gallery);

        $pagination = new Pagination($totalOfContent, $this->currentPage, MainPage::ITEMS_ON_PAGE);

        if ($page > $pagination->amount)
            header('Location: /' . $gallery . '/1');

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


}
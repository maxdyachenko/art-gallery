<?php

class GalleryListPageController
{
    public $current = "Gallery list";

    public function actionIndex(){

        require_once(ROOT . '/views/site/gallery-list.php');
        return true;
    }

    public function getContent(){
        return GalleryListPage::getContent();
    }
}
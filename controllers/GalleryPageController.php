<?php

class GalleryPageController
{
    public $current = "Gallery list";

    public function actionIndex(){

        require_once(ROOT . '/views/site/gallery.php');
        return true;
    }

    public function getContent(){
        return GalleryPage::getContent();
    }
}
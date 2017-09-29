<?php
require_once(ROOT . '/models/MainPage.php');
class MainPageController{
    public function actionContent() {
        if (!MainPage::isLogged())
            header('Location: /');
        require_once(ROOT . '/views/site/news.php');
        return true;
    }
}
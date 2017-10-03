<?php
require_once(ROOT . '/models/EditPage.php');
class EditPageController
{
    public function actionEdit() {
        require_once(ROOT . '/views/site/edit-profile.php');
        return true;
    }
}
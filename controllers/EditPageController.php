<?php
class EditPageController{
    public $current = 'Edit profile';

    private $name;
    private $lastName;

    public function __construct()
    {
        $this->model = new EditPage(Db::getConnection());
        if (!MainPage::isLogged()) {
            header('Location: /');
            exit;
        }
        $this->userAvatar = $this->model->getUserAvatar();
    }

    public function actionEdit() {
        require_once(ROOT . '/views/site/edit-profile.php');

        $this->editName();

        return true;
    }

    public function editName() {
        if (isset($_POST['editNameForm'])){
            $this->name = FrontPage::safeInput($_POST['userName']);
            $this->lastName = FrontPage::safeInput($_POST['userLastName']);
        }
    }
}
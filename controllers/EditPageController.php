<?php
class EditPageController{
    public $current = 'Edit profile';

    private $name;
    private $lastName;
    private $oldPswd;
    private $newPswd;

    public $errorsName = [];
    public $errorsPswd = [];
    public $isPswdChanged = false;
    public $imgMistake;

    public $activeTab = 1;


    public function __construct()
    {
        $this->model = new EditPage(Db::getConnection());
        if (!BaseModel::isLogged()) {
            header('Location: /');
            exit;
        }
        $this->userAvatar = $this->model->getUserAvatar();
    }

    public function actionEdit() {

        $this->editName();
        $this->editPswd();
        $this->editAvatar();
        require_once(ROOT . '/views/site/edit-profile.php');
        return true;
    }

    public function editName() {
        if (isset($_POST['editNameForm'])){
            $this->name = FrontPage::safeInput($_POST['userName']);
            $this->lastName = FrontPage::safeInput($_POST['userLastName']);

            if (!FrontPage::checkName($this->name)) {
                $this->errorsName['name'] = 1;
            }
            if (!FrontPage::checkName($this->lastName)) {
                $this->errorsName['lastname'] = 1;
            }

            if (empty($this->errorsName)){
                $this->model->updateNames($this->name, $this->lastName);
            }
        }
    }

    public function editPswd() {
        if (isset($_POST['editPswdForm'])){
            $this->oldPswd = FrontPage::safeInput($_POST['oldPswd']);
            $this->newPswd = FrontPage::safeInput($_POST['newPswd']);

            if (!$this->model->checkPswdCorrect($this->oldPswd)) {
                $this->errorsPswd['old'] = 1;
            }
            if (!FrontPage::checkPswd($this->newPswd)) {
                $this->errorsPswd['new'] = 1;
            }

            if (empty($this->errorsPswd)){
                $this->isPswdChanged = true;
                $hash = password_hash($this->newPswd, PASSWORD_DEFAULT);
                $this->model->updatePswd($hash);
            } else{
                $this->activeTab = 2;
            }
        }
    }

    public function editAvatar(){
        $dirName = "{$_SERVER['DOCUMENT_ROOT']}/assets/img/{$_SESSION['id']}/";
        !file_exists($dirName) ? mkdir($dirName, 0755) : false;
        if (isset($_POST['editAvatarForm'])){
            $temp = explode(".", $_FILES['file']['name']);
            $newfilename = 'avatar.' . end($temp);
            if (file_exists($dirName . $newfilename)){
                unlink($dirName . $newfilename);
            }
            $this->imgMistake = GalleryPage::getImageMistake();
            if (!$this->imgMistake) {
                move_uploaded_file($_FILES['file']['tmp_name'], $dirName . $newfilename);
                $this->model->uploadImage($newfilename);
            }
        }
    }
}
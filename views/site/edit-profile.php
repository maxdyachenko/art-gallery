<?php include ROOT . '/views/layouts/head.php' ?>
<body class="edit-profile">
<?php include ROOT . '/views/layouts/menu.php' ?>

<div class="content">
    <section class="container content-container">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link <?php if ($this->activeTab == 1) echo 'active' ?>" data-toggle="tab" href="#name" role="tab">Name</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($this->activeTab == 2) echo 'active' ?>" data-toggle="tab" href="#pswd" role="tab">Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#avatar" role="tab">Avatar</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane <?php if ($this->activeTab == 1) echo 'active' ?>" id="name" role="tabpanel">
                <form action="/edit-profile" method="post" class="user-edit-form">
                    <div class="form-group">
                        <label for="nameInput">First Name</label>
                        <input type="text" class="form-control" name="userName" id="nameInput" aria-describedby="lastName" placeholder="Enter New First Name">
                        <div class="invalid-feedback <?php if ($this->errorsName['name']) echo 'visible'; ?>">Name should be min 2 chars max 16 chars</div>
                    </div>
                    <div class="form-group">
                        <label for="lastNameInput">Last Name</label>
                        <input type="text" class="form-control" id="lastNameInput" name="userLastName" aria-describedby="lastName" placeholder="Enter New Last Name">
                        <div class="invalid-feedback <?php if ($this->errorsName['lastname']) echo 'visible'; ?>">Last Name should be min 2 chars max 16 chars</div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="editNameForm">Submit</button>
                </form>
            </div>
            <div class="tab-pane <?php if ($this->activeTab == 2) echo 'active' ?>" id="pswd" role="tabpanel">
                <?php if ($this->isPswdChanged): ?>
                    <div class="invalid-feedback visible">Your password succesfully changed!</div>
                <?php endif; ?>
                <form action="/edit-profile" method="post" class="pswd-edit-form">
                    <div class="form-group">
                        <label for="InputPassword1">Old Password</label>
                        <input type="password" class="form-control" name="oldPswd" id="InputPassword1" placeholder="Old Password">
                        <div class="invalid-feedback <?php if ($this->errorsPswd['old']) echo 'visible'; ?>">Incorrect password</div>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword2">New Password</label>
                        <input type="password" class="form-control" name="newPswd" id="InputPassword2" placeholder="New Password">
                        <div class="invalid-feedback <?php if ($this->errorsPswd['new']) echo 'visible'; ?>">Password should be min 6 chars max 16 chars</div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="editPswdForm">Submit</button>
                </form>
            </div>
            <div class="tab-pane" id="avatar" role="tabpanel">
                <form method="post" action="/edit-profile" class="avatar-edit-form" enctype="multipart/form-data">
                    <label class="custom-file">
                        <input type="file" id="file2" name="file" class="custom-file-input" required>
                        <span class="custom-file-control"></span>
                    </label><br>
                    <div class="invalid-feedback"><?php if($this->imgMistake) echo $this->imgMistake; ?></div>
                    <button type="submit" class="btn btn-primary" name="editAvatarForm">Submit</button>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include ROOT . '/views/layouts/footer.php' ?>
<script src="/assets/scripts/edit-page.js"></script>
</body>
</html>

<?php include ROOT . '/views/layouts/head.php' ?>
<body class="edit-profile">
<?php include ROOT . '/views/layouts/menu.php' ?>

<div class="content">
    <section class="container content-container">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Name</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#messages" role="tab">Avatar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Email</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="home" role="tabpanel">
                <form action="/edit-profile" method="post" class="user-edit-form">
                    <div class="form-group">
                        <label for="nameInput">First Name</label>
                        <input type="text" class="form-control" name="userName" id="nameInput" aria-describedby="lastName" placeholder="Enter New First Name">
                        <div class="invalid-feedback">Name should be min 2 chars max 16 chars</div>
                    </div>
                    <div class="form-group">
                        <label for="lastNameInput">Last Name</label>
                        <input type="text" class="form-control" id="lastNameInput" name="userLastName" aria-describedby="lastName" placeholder="Enter New Last Name">
                        <div class="invalid-feedback">Last Name should be min 2 chars max 16 chars</div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="editNameForm">Submit</button>
                </form>
            </div>
            <div class="tab-pane" id="profile" role="tabpanel">
                <form>
                    <div class="form-group">
                        <label for="InputPassword1">Old Password</label>
                        <input type="password" class="form-control" id="InputPassword1" placeholder="Old Password">
                    </div>
                    <div class="form-group">
                        <label for="InputPassword2">New Password</label>
                        <input type="password" class="form-control" id="InputPassword2" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="InputPassword3">Confrim New Password</label>
                        <input type="password" class="form-control" id="InputPassword3" placeholder="Confrim New Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="tab-pane" id="messages" role="tabpanel">
                <label class="custom-file">
                    <input type="file" id="file2" class="custom-file-input">
                    <span class="custom-file-control"></span>
                </label>
            </div>
            <div class="tab-pane" id="settings" role="tabpanel">
                <form>
                    <div class="form-group">
                        <label for="InputEmail1">Old Email address</label>
                        <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" placeholder="Enter Old email">
                    </div>
                    <div class="form-group">
                        <label for="InputEmail2">New Email address</label>
                        <input type="email" class="form-control" id="InputEmail2" aria-describedby="emailHelp" placeholder="Enter New email">
                    </div>
                </form>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </section>
</div>

<?php include ROOT . '/views/layouts/footer.php' ?>
<script src="/assets/scripts/edit-page.js"></script>
</body>
</html>

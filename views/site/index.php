<?php include ROOT . '/views/layouts/head.php' ?>
<body class="front-page">
<a href="news.html">News</a>
<div class="container-fluid">
    <div class="row justify-content-between">
        <div class="col-md-3">

        </div>
        <div class="col-md-3 front-box">
            <form class="sign-in <?php if (isset($errors) && !empty($errors)) echo 'disable' ?>">
                <div class="form-group">
                    <label for="InputEmail1">Email address</label>
                    <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp"
                           placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="InputPassword1">Password</label>
                    <input type="password" class="form-control" id="InputPassword1" placeholder="Password">
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input">
                        Remember me
                    </label>
                </div>
                <div class="buttons-container">
                    <button type="submit" class="btn btn-primary" name="auth">Sign in</button>
                    <button type="submit" class="btn btn-primary" id="signup-button">Sign up</button>
                </div>
            </form>
            <form class="sign-up <?php if (isset($errors) && !empty($errors)) echo 'active' ?>" action="#" method="post">
                <div class="form-group">
                    <label for="regEmail">Email address</label>
                    <input type="email" class="form-control" id="regEmail" name="regEmail" aria-describedby="emailHelp"
                           placeholder="Enter email" value="<?php if(isset($mail))echo $mail; ?>" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.
                    </small>
                    <div class="invalid-feedback visible"><?php if (!empty($errors) && isset($errors['mail'])) echo $errors['mail']; ?></div>
                </div>
                <div class="form-group">
                    <label for="regPswd">Password</label>
                    <input type="password" class="form-control" id="regPswd" name="regPswd" placeholder="Password" required>
                    <small id="password-help" class="form-text text-muted">Minimum 6 symbols.</small>
                    <div class="invalid-feedback visible"><?php if (!empty($errors) && isset($errors['pswd'])) echo $errors['pswd']; ?></div>
                </div>
                <div class="form-group">
                    <label for="regPswd2">Confirm Password</label>
                    <input type="password" class="form-control" id="regPswd2" name="regPswd2"
                           placeholder="Confirm Password" required>
                    <div class="invalid-feedback visible"><?php if (!empty($errors) && isset($errors['pswd2'])) echo $errors['pswd2']; ?></div>
                </div>
                <div class="form-group">
                    <label for="regName">Your Name</label>
                    <input type="text" class="form-control" name="regName" id="regName" placeholder="Your Name" value="<?php if(isset($name))echo $name; ?>" required>
                    <small id="password-help" class="form-text text-muted">Minimum 2 symbols.</small>
                    <div class="invalid-feedback visible"><?php if (!empty($errors) && isset($errors['name'])) echo $errors['name']; ?></div>
                </div>
                <div class="form-group">
                    <label for="regLastName">Your Last Name</label>
                    <input type="text" class="form-control" name="regLastName" id="regLastName"
                           placeholder="Your Last Name" value="<?php if(isset($lastName))echo $lastName; ?>" required>
                    <small id="password-help" class="form-text text-muted">Minimum 2 symbols.</small>
                    <div class="invalid-feedback visible"><?php if (!empty($errors) && isset($errors['lastName'])) echo $errors['lastName']; ?></div>
                </div>

                <button type="submit" class="btn btn-primary" name="register">Sign Up</button>
            </form>

        </div>
    </div>
</div>
<script>
    var signupButton = document.getElementById('signup-button'),
        signupForm = document.getElementsByClassName('sign-up')[0],
        signinForm = document.getElementsByClassName('sign-in')[0];
    signupButton.addEventListener('click', function () {
        event.preventDefault();
        signinForm.classList.add('disable');
        signupForm.classList.add('active');
    })
</script>
</body>
</html>
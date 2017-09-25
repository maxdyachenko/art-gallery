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
            <form class="sign-up <?php if (isset($errors) && !empty($errors)) echo 'active'; ?>" action="#" method="post">
                <div class="form-group">
                    <label for="regEmail">Email address</label>
                    <input type="email" class="form-control" id="regEmail" name="regEmail" aria-describedby="emailHelp"
                           placeholder="Enter email" value="<?php if(isset($mail))echo $mail; ?>" required>
                    <div class="invalid-feedback <?php if (isset($errors['mail'])) echo 'visible'; ?>"><?php if (isset($errors['mail']) && $errors['mail'] == 2) echo "Email already exist"; else echo "Invalid email";?></div>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.
                    </small>
                </div>
                <div class="form-group">
                    <label for="regPswd">Password</label>
                    <input type="password" class="form-control" id="regPswd" name="regPswd" placeholder="Password" required>
                    <div class="invalid-feedback <?php if (isset($errors['pswd'])) echo 'visible'; ?>">Password should include at least 6 characters</div>
                    <small id="password-help" class="form-text text-muted">Minimum 6 symbols.</small>
                </div>
                <div class="form-group">
                    <label for="regPswd2">Confirm Password</label>
                    <input type="password" class="form-control" id="regPswd2" name="regPswd2"
                           placeholder="Confirm Password" required>
                    <div class="invalid-feedback <?php if (isset($errors['pswd2'])) echo 'visible'; ?>">Passwords dont match</div>
                </div>
                <div class="form-group">
                    <label for="regName">Your Name</label>
                    <input type="text" class="form-control" name="regName" id="regName" placeholder="Your Name" value="<?php if(isset($name))echo $name; ?>" required>
                    <div class="invalid-feedback <?php if (isset($errors['name'])) echo 'visible'; ?>">Name should be at leas 2 symbols</div>                    <small id="password-help" class="form-text text-muted">Minimum 2 symbols.</small>

                </div>
                <div class="form-group">
                    <label for="regLastName">Your Last Name</label>
                    <input type="text" class="form-control" name="regLastName" id="regLastName"
                           placeholder="Your Last Name" value="<?php if(isset($lastName))echo $lastName; ?>" required>
                    <div class="invalid-feedback <?php if (isset($errors['lastName'])) echo 'visible'; ?>">Last Name should be at leas 2 symbols</div>
                    <small id="password-help" class="form-text text-muted">Minimum 2 symbols.</small>
                </div>

                <button type="submit" class="btn btn-primary" name="register" id="registerButton">Sign Up</button>
            </form>

        </div>
    </div>
</div>
<script src="/assets/scripts/front-page.js"></script>
</body>
</html>
<nav class="main-menu navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Art Gallery</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/edit-profile">Edit profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Exit</a>
            </li>
            <li class="nav-item">
                <div class="user-block">
                    <img src="assets/img/front-bg.jpg" alt="Your avatar" class="user-avatar">
                    <p class="caption">Hello, <?php echo $_SESSION['username']; ?></p>
                </div>
            </li>
        </ul>
    </div>
</nav>
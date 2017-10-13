<?php include ROOT . '/views/layouts/head.php' ?>
<body>
<?php include ROOT . '/views/layouts/menu.php' ?>
<div class="content"><section class="container news-container content-container">
        <a href="/create-gallery" class="btn btn-primary">Create gallery</a>
        <?php foreach ($this->getContent() as $value): ?>
            <div class="card card-custom">
                <img class="card-img-top" src="<?php echo '/assets/img/gallerys/' . $_SESSION['id'] . '/' . $value['name'] . '/gallery-avatar.jpg' ?>" alt="Card image cap">
                <div class="card-block">
                    <h4 class="card-title"><?php echo $value['name'] ?></h4>
                    <a href="#" class="btn btn-primary">Open Gallery</a>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

</div>

</body>
<?php include ROOT . '/views/layouts/footer.php' ?>
</html>

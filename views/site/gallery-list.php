<?php include ROOT . '/views/layouts/head.php' ?>
<body>
<?php include ROOT . '/views/layouts/menu.php' ?>
<div class="content"><section class="container news-container content-container">
        <a href="/create-gallery" class="btn btn-primary">Create gallery</a>
        <?php foreach ($this->getContent() as $value): ?>
            <div class="card card-custom">
                <?php $ext = explode('.',$value['avatar']); $ext =  $ext[count($ext) - 1]; ?>
                <img class="card-img-top" src="<?php echo '/assets/img/gallerys/' . $_SESSION['id'] . '/' . $value['name'] . '/gallery-avatar.' . $ext; ?>" alt="Card image cap">
                <div class="card-block">
                    <h4 class="card-title"><?php echo $value['name'] ?></h4>
                    <div class="buttons-group">
                        <a href="/gallery/<?php echo $value['name'] ?>" class="btn btn-primary">Open Gallery</a>
                        <button type="button" class="btn btn-danger delete-all" data-toggle="modal" data-target="#delete-image-popup" data-name="<?php echo $value['name'] ?>">Delete Gallery</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

</div>

<div id="delete-image-popup" class="modal fade show" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <form method="post" action="/delete-gallery">
                    <input type="hidden" name="name">
                    <button type="submit" class="btn btn-primary delete-btn">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
<?php include ROOT . '/views/layouts/footer.php' ?>
<script src="/assets/scripts/gallery-list.js"></script>
</html>

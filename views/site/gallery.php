<?php include ROOT . '/views/layouts/head.php' ?>
<body class="news-page">
<?php include ROOT . '/views/layouts/menu.php' ?>

<div class="content">
    <section class="container news-container content-container">
        <div class="row justify-content-between images-wrapper">
            <?php $this->updateContent(); ?>
        </div>

        <?php echo  $pagination->get(); ?>
    </section>
</div>

<div id="delete-image-popup" class="modal fade show" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>Delete the image?</p>
            </div>
            <div class="modal-footer">
                <form action="/delete" method="post">
                    <input type="hidden" name="name">
                    <input type="hidden" name="gallery" value="<?php echo $this->gallery ?>">
                    <button type="submit" class="btn btn-primary delete-btn">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="zoom-container">
    <div class="zoom-popup">
        <span class="fa fa-remove fa-2x close-button"></span>
        <img src="" alt="">
    </div>
</div>

<?php include ROOT . '/views/layouts/footer.php' ?>
<script src="/assets/scripts/gallery-page.js"></script>
</body>
</html>

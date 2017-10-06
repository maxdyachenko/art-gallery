<?php include ROOT . '/views/layouts/head.php' ?>
<body class="news-page">
<?php include ROOT . '/views/layouts/menu.php' ?>

<section class="container news-container content-container">
    <div class="row justify-content-between images-wrapper">
        <?php $this->updateContent(); ?>
    </div>

    <?php echo  $pagination->get(); ?>
</section>

<div id="delete-image-popup" class="modal fade show" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>Delete the image?</p>
            </div>
            <div class="modal-footer">
                <form action="/delete" method="post">
                    <input type="hidden" name="name">
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

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="/assets/scripts/news-page.js"></script>
</body>
</html>

<?php include ROOT . '/views/layouts/head.php' ?>
<body class="news-page">
<?php include ROOT . '/views/layouts/menu.php' ?>

<section class="container news-container content-container">
    <div class="row justify-content-between">
        <div class="image-container col-12 col-md-4">
            <form action="/main" method="post">
                <div class="button-container">
                    <input type="file" name="file" id="file" class="add-button input-file" />
                    <label for="file">
                        <figure></figure>
                        <p>Choose file...</p>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
        <?php foreach($userContent as $key=>$value): ?>
            <div class="image-container col-12 col-md-4">
                <img src="assets/img/<?php echo $value; ?>" alt="Your image" class="rounded">
                <div class="custom-popover">
                    <button type="button" class="btn btn-primary">Zoom</button>
                    <button type="button" class="btn btn-danger" id="delete-image" data-toggle="modal" data-target="#delete-image-popup">Delete image</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <nav aria-label="Images pages">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</section>

<div id="delete-image-popup" class="modal fade show" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>Delete the image?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Confirm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="/assets/scripts/news-page.js"></script>
</body>
</html>

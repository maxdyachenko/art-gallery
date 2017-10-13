<?php include ROOT . '/views/layouts/head.php' ?>
<body>
<?php include ROOT . '/views/layouts/menu.php' ?>
<div class="content">
    <section class="container news-container content-container">
        <h2>Create your gallery:</h2>
        <form action="/create-gallery-form" method="post" enctype="multipart/form-data">
            <label class="custom-file">
                <input type="file" id="file2" name="file" class="custom-file-input" required>
                <span class="custom-file-control"></span>
            </label><br>
            <div class="invalid-feedback visible"></div>
            <input type="text" class="form-control" id="galleryName" name="galleryName" placeholder="Enter Gallery Name">
            <div class="invalid-feedback visible"></div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </section>
</div>


</body>
<?php include ROOT . '/views/layouts/footer.php' ?>
</html>
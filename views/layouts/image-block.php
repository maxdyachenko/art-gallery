<div class="image-container col-12 col-md-4">
    <img src="assets/img/<?php echo "{$_SESSION['id']}/{$value}"; ?>" alt="Your image" class="rounded">
    <div class="custom-popover">
        <button type="button" class="btn btn-primary">Zoom</button>
        <button type="button" class="btn btn-danger" id="delete-image" data-toggle="modal" data-target="#delete-image-popup" data-name="<?php echo $value; ?>">Delete image</button>
    </div>
</div>
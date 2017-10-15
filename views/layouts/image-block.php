<div class="image-container col-12 col-md-4">
    <div class="image">
        <img src="/assets/img/gallerys/<?php echo "{$_SESSION['id']}/{$this->gallery}/{$value}"; ?>" alt="Your image" class="rounded">
    </div>
    <div class="custom-popover">
        <button type="button" class="btn btn-primary zoom-button" data-src="/assets/img/gallerys/<?php echo "{$_SESSION['id']}/{$this->gallery}/{$value}"; ?>">Zoom</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-image-popup" data-name="<?php echo $value; ?>">Delete image</button>
    </div>
</div>
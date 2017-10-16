<div class="image-container col-12 col-md-4">
    <div class="image">
        <img src="/assets/img/gallerys/<?php echo "{$_SESSION['id']}/{$this->gallery}/{$value}"; ?>" alt="Your image" class="rounded">
    </div>
    <div class="custom-popover">
        <button type="button" class="btn btn-primary zoom-button" data-src="/assets/img/gallerys/<?php echo "{$_SESSION['id']}/{$this->gallery}/{$value}"; ?>">Zoom</button>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="chk[]" value="<?php echo $value ?>">
            </label>
        </div>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-image-popup" data-name="<?php echo $value; ?>">Delete image</button>
    </div>
</div>
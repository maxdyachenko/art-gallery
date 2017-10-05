<div class="image-container col-12 col-md-4 add-image-block">
    <form action="/main" method="post" id="uploadForm" enctype="multipart/form-data">
        <div class="button-container">
            <input type="file" name="file" id="file" class="add-button input-file" />
            <label for="file">
                <figure></figure>
                <p>Choose file...</p>
                <div class="invalid-feedback <?php if ($this->imgMistake) echo 'visible'; ?>"><?php if ($this->imgMistake) echo $this->imgMistake;?></div>
            </label>
        </div>
        <button type="submit" class="btn btn-primary" name="upload-image">Upload</button>
    </form>
</div>
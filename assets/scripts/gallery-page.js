document.addEventListener('DOMContentLoaded', function() {

    var uploadForm = document.getElementById('uploadForm'),
        fileInput = document.getElementById('file'),
        error = document.getElementsByClassName('invalid-feedback')[0],
        label	 = fileInput.nextElementSibling,
        labelVal = label.innerHTML,
        fileName;

    uploadForm.addEventListener('submit', function() {
        if (!fileName) {
            event.preventDefault();
        }
    });

    fileInput.addEventListener('change', function(e){
        fileName = e.target.value.split('\\').pop();
        if(checkFile()) {
            label.querySelector('p').innerHTML = fileName;
        }
        else{
            fileName = null;
        }
    });

    function getFileSize() {
        if (typeof (fileInput.files) !== "undefined") {
            return parseFloat(fileInput.files[0].size / 1024).toFixed(2);
        } else {
            return false;
        }
    }

    function checkFileExtension(){
        return fileName.match(/^.*\.(jpg|JPG|png|PNG)$/);
    }


    function checkFile() {
        if (getFileSize() > 2000){
            error.classList.add('visible');
            error.innerHTML = "Image size should be less than 2Mb";
            return false;
        }
        else if (!checkFileExtension()){
            error.classList.add('visible');
            error.innerHTML = "Upload only PNG or JPG";
            return false;
        }
        else{
            error.classList.remove('visible');
            error.innerHTML = "";
        }
        return true;
    }


    $('#delete-image-popup').on('shown.bs.modal', function (e) {
        var imgName, input, gallery,
            form = this.getElementsByTagName('form')[0];
        if (e.relatedTarget.classList.contains('delete-all')) {
            gallery = e.relatedTarget.getAttribute('data-name');
            form.setAttribute('action', '/remove-all-images/' + gallery);
        }
        else {
            imgName = e.relatedTarget.getAttribute('data-name');
            input = this.getElementsByTagName('input')[0];
            input.setAttribute('value',imgName);
            form.setAttribute('action', '/delete');
        }
    });



    var zoomPopup = document.getElementById('zoom-container'),
        zoomBtn = document.getElementsByClassName('zoom-button'),
        closeBtn = document.getElementsByClassName('close-button')[0],
        img = zoomPopup.getElementsByTagName('img')[0];


    for (var i = 0;i < zoomBtn.length; i++) {
        zoomBtn[i].addEventListener('click', openZoomPopup)
    }

    function openZoomPopup() {
        document.body.classList.add('modal-open');
        zoomPopup.classList.add('open');
        img.src = this.getAttribute('data-src');
    }

    closeBtn.addEventListener('click', function(){
        document.body.classList.remove('modal-open');
        zoomPopup.classList.remove('open');
    });

    
    

});


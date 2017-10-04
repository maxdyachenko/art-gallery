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

    var imgToDelete,
        imgsWrapper = document.getElementsByClassName('images-wrapper')[0],
        deleteBtn = document.getElementsByClassName('delete-btn')[0];

    $('#delete-image-popup').on('shown.bs.modal', function (e) {
        imgToDelete = e.relatedTarget.getAttribute('data-name');
    });
    
    deleteBtn.addEventListener('click', function () {
        $.ajax({
            type: "POST",
            url: "/deleteImage",
            data: {'imgName': imgToDelete},
            success: function (html) {
                imgsWrapper.innerHTML =html;
            }
        })
    });
    
    

});


var fileInput = document.getElementById('file'),
    label	 = fileInput.nextElementSibling,
    labelVal = label.innerHTML;

fileInput.addEventListener('change', function(e){
    var fileName = e.target.value.split('\\').pop();

    if(fileName)
        label.querySelector('p').innerHTML = fileName;
    else
        label.innerHTML = labelVal;
});

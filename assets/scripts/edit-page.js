document.addEventListener('DOMContentLoaded', function() {
    var username = document.getElementById('nameInput'),
        userLastName = document.getElementById('lastNameInput');
        userEditForm = document.getElementsByClassName('user-edit-form')[0];

    userEditForm.addEventListener('submit', nameFormValidate);

    function nameFormValidate() {
        !isCorrectName(username) ? addMistakeClass(username): removeMistakeClass(username);
        !isCorrectName(userLastName) ? addMistakeClass(userLastName): removeMistakeClass(userLastName);
    }
    function isCorrectName(element){
        return element.value.length > 1 && element.value.length < 17;
    }
    function addMistakeClass(element){
        element.nextElementSibling.classList.add('visible');
        event.preventDefault()
    }
    function removeMistakeClass(element) {
        element.nextElementSibling.classList.remove('visible');
    }
});

    
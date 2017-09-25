document.addEventListener('DOMContentLoaded', function() {
    var signupButton = document.getElementById('signup-button'),
        signupForm = document.getElementsByClassName('sign-up')[0],
        registerButton = document.getElementById('registerButton'),
        regEmail = document.getElementById('regEmail'),
        regPswd = document.getElementById('regPswd'),
        regPswd2 = document.getElementById('regPswd2'),
        regName = document.getElementById('regName'),
        regLastName = document.getElementById('regLastName'),
        signinForm = document.getElementsByClassName('sign-in')[0];

    //activate animation
    signupButton.addEventListener('click', function () {
        event.preventDefault();
        signinForm.classList.add('disable');
        signupForm.classList.add('active');
    });

    signupForm.addEventListener('submit', validateRegForm)

    function validateRegForm() {
        !isCorrectEmail()? addMistakeClass(regEmail): removeMistakeClass(regEmail);
        !isCorrectPswd() ? addMistakeClass(regPswd): removeMistakeClass(regPswd);
        !isConfirmedPswd() ? addMistakeClass(regPswd2): removeMistakeClass(regPswd2);
        !isCorrectName(regName) ? addMistakeClass(regName): removeMistakeClass(regName);
        !isCorrectName(regLastName) ? addMistakeClass(regLastName): removeMistakeClass(regLastName);
    }

    function addMistakeClass(element) {
        element.nextElementSibling.classList.add('visible');
        event.preventDefault();
    }

    function removeMistakeClass(element) {
        element.nextElementSibling.classList.remove('visible');
    }

    function isCorrectPswd() {
        if (regPswd.value.length > 5)
            return true;
        return false;
    }

    function isCorrectName(element){
        if (element.value.length > 1)
            return true;
        debugger;
        return false;
    }
    function isConfirmedPswd() {
        if (regPswd.value === regPswd2.value)
            return true;
        return false;
    }

    function isCorrectEmail() {
        var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return regex.test(regEmail.value);
    }
});


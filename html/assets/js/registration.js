function checkEmail(inputElement, oldEmail) {

    "use strict";

    if (inputElement.value.length < 6 || !inputElement.value.match('^.+@.+\..+$')) {
        inputElement.classList.remove("is-success");
        inputElement.classList.add("is-danger");
        return;
    } else {
        inputElement.classList.remove("is-danger");
    }

    var checkIsDuplicateRequest = new XMLHttpRequest();
    checkIsDuplicateRequest.onreadystatechange = () => {
        if (checkIsDuplicateRequest.readyState == 4 && checkIsDuplicateRequest.status == 200) {
            let response = JSON.parse(checkIsDuplicateRequest.responseText);

            if (response.exists) {
                if (oldEmail == inputElement.value.trim()) {
                    inputElement.classList.remove("is-danger");
                    inputElement.classList.add("is-success");
                    inputElement.setCustomValidity("");
                } else {
                    inputElement.classList.remove("is-success");
                    inputElement.classList.add("is-danger");
                    inputElement.setCustomValidity("Email giá in uso");
                }
            } else {
                inputElement.classList.remove("is-danger");
                inputElement.classList.add("is-success");
                inputElement.setCustomValidity("");
            }
        }
    }

    let URL = `registration.php?checkEmail=${encodeURI(inputElement.value.toLowerCase().trim())}`;
    checkIsDuplicateRequest.open("GET", URL);
    checkIsDuplicateRequest.send();
}

function checkUsername(inputElement) {

    "use strict";

    if (inputElement.value.length < 3 || !inputElement.value.match(RegExp(inputElement.pattern))) {
        inputElement.classList.remove("is-success");
        inputElement.classList.add("is-danger");
        return;
    } else {
        inputElement.classList.remove("is-danger");
    }

    var checkIsDuplicateRequest = new XMLHttpRequest();
    checkIsDuplicateRequest.onreadystatechange = () => {
        if (checkIsDuplicateRequest.readyState == 4 && checkIsDuplicateRequest.status == 200) {
            let response = JSON.parse(checkIsDuplicateRequest.responseText);

            if (response.exists) {
                inputElement.classList.remove("is-success");
                inputElement.classList.add("is-danger");
                inputElement.setCustomValidity("Username giá in uso");
            } else {
                inputElement.classList.remove("is-danger");
                inputElement.classList.add("is-success");
                inputElement.setCustomValidity("");
            }
        }
    }

    let URL = `registration.php?checkUsername=${encodeURI(inputElement.value.toLowerCase())}`;
    checkIsDuplicateRequest.open("GET", URL);
    checkIsDuplicateRequest.send();
}

function checkPassword() {
    let passwordElements = document.querySelectorAll("[type='password']");
    if (passwordElements[0].value === passwordElements[1].value && passwordElements[0].value.length >= 6) {
        passwordElements.forEach((e) => {
            e.classList.remove("is-danger");
            e.classList.add("is-success");
            e.setCustomValidity("");
        });
    } else {
        passwordElements.forEach((e) => {        
            e.classList.remove("is-success");
            e.classList.add("is-danger");
            if (passwordElements[0].value.length < 6)
                e.setCustomValidity("Password troppo corta");
            else
                e.setCustomValidity("Le password non corrispondono");
        });
    }
}
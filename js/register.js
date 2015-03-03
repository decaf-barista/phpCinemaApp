function validateRegistration(form) {
    //assigns new variable to inout fields//
    var username = form['username'].value;
    var password = form['password'].value;
    var password2 = form['password2'].value;

    var spanElements = document.getElementsByClassName("error");//create error variable//
    for (var i = 0; i !== spanElements.length; i++) {//loop for the error variable//
        spanElements[i].innerHTML = "";
    }

    var errors = new Object();

    if (username === "") {
        errors["username"] = "Username cannot be empty\n";
    }
    if (password === "") {
        errors["password"] = "Password cannot be empty\n";
    }
    if (password2 === "") {
        errors["password2"] = "Password2 cannot be empty\n";
    }
    else if (password === password2) {
        errors["password2"] = "Passwords must match\n";
    }

    var valid = true;
    for (var index in errors) {
        valid = false;//changes valid to false if there are error messages//
        var errorMessage = errors[index];
        var spanElement = document.getElementById(index + "Error");
        spanElement.innerHTML = errorMessage;
    }
    return true;
}










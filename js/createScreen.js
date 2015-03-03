function validateCreateScreen(form) {
    //assigns new variables to the input fields//

    var seatNumber = form['seatNumber'].value;
    var fireExits = form['fireExits'].value;
    
    var spanElements = document.getElementsByClassName("error");//create error variable//
    for (var i = 0; i !== spanElements.length; i++) {//loop for the error variable//
        spanElements[i].innerHTML = "";
    }

    var errors = new Object();

    if (seatNumber === "") {
        errors["seatNumber"] = "Seats cannot be empty\n";//adds error to array if seats is blank//
    }
    if (fireExits === "") {
        errors["fireExits"] = "Fire Exits cannot be empty\n";//adds error to array if fireExits is blank//
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



window.onload = function () {
    //-------------------------------------------------------------------------
    // define an event listener for the '#createScreenForm'
    //-------------------------------------------------------------------------
    var createScreenForm = document.getElementById('createScreenForm');
    if (createScreenForm !== null) {
        createScreenForm.addEventListener('submit', validateScreenForm);
    }

    function validateScreenForm(event) {
        var form = event.target;
        
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

        if (!valid || !confirm("Is the form data correct?")) {
            event.preventDefault();
        }
    }

    //-------------------------------------------------------------------------
    // define an event listener for the '#createScreenForm'
    //-------------------------------------------------------------------------
    var editScreenForm = document.getElementById('editScreenForm');
    if (editScreenForm !== null) {
        editScreenForm.addEventListener('submit', validateScreenForm);
    }

    //-------------------------------------------------------------------------
    // define an event listener for any '.deleteScreen' links
    //-------------------------------------------------------------------------
    var deleteLinks = document.getElementsByClassName('deleteScreen');
    for (var i = 0; i !== deleteLinks.length; i++) {
        var link = deleteLinks[i];
        link.addEventListener("click", deleteLink);
    }

    function deleteLink(event) {
        if (!confirm("Are you sure you want to delete this screen?")) {
            event.preventDefault();
        }
    }

};
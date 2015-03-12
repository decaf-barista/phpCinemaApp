window.onload = function () {
    //-------------------------------------------------------------------------
    // define an event listener for the '#createGenreForm'
    //-------------------------------------------------------------------------
    var createGenreForm = document.getElementById('createGenreForm');
    if (createGenreForm !== null) {
        createGenreForm.addEventListener('submit', validateGenreForm);
    }

    function validateGenreForm(event) {
        var form = event.target;
        
        var genreName = form['genreName'].value;
        var decription = form['decription'].value;

        var spanElements = document.getElementsByClassName("error");//create error variable//
        for (var i = 0; i !== spanElements.length; i++) {//loop for the error variable//
            spanElements[i].innerHTML = "";
        }

        var errors = new Object();

        if (genreName === "") {
            errors["genreName"] = "Genre name cannot be empty\n";//adds error to array if seats is blank//
        }
        if (decription === "") {
            errors["decription"] = "Description cannot be empty\n";//adds error to array if decription is blank//
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
    // define an event listener for the '#createGenreForm'
    //-------------------------------------------------------------------------
    var editGenreForm = document.getElementById('editGenreForm');
    if (editGenreForm !== null) {
        editGenreForm.addEventListener('submit', validateGenreForm);
    }

    //-------------------------------------------------------------------------
    // define an event listener for any '.deleteGenre' links
    //-------------------------------------------------------------------------
    var deleteLinks = document.getElementsByClassName('deleteGenre');
    for (var i = 0; i !== deleteLinks.length; i++) {
        var link = deleteLinks[i];
        link.addEventListener("click", deleteLink);
    }

    function deleteLink(event) {
        if (!confirm("Are you sure you want to delete this genre?")) {
            event.preventDefault();
        }
    }

};
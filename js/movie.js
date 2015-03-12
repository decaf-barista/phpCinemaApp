window.onload = function () {
    //-------------------------------------------------------------------------
    // define an event listener for the '#createMovieForm'
    //-------------------------------------------------------------------------
    var createMovieForm = document.getElementById('createMovieForm');
    if (createMovieForm !== null) {
        createMovieForm.addEventListener('submit', validateMovieForm);
    }

    function validateMovieForm(event) {
        var form = event.target;
        
        var title = form['title'].value;
        var movieYear = form['movieYear'].value;
        var runTime = form['runTime'].value;
        var classification = form['classification'].value;
        var directorFName = form['directorFName'].value;
        var directorLName = form['directorLName'].value;

        var spanElements = document.getElementsByClassName("error");//create error variable//
        for (var i = 0; i !== spanElements.length; i++) {//loop for the error variable//
            spanElements[i].innerHTML = "";
        }

        var errors = new Object();

        if (title === "") {
            errors["title"] = "Title cannot be empty\n";//adds error to array if seats is blank//
        }
        if (movieYear === "") {
            errors["movieYear"] = "Movie year cannot be empty\n";//adds error to array if fireExits is blank//
        }
        if (runTime === "") {
            errors["runTime"] = "Movie year cannot be empty\n";//adds error to array if fireExits is blank//
        }
        if (classification === "") {
            errors["classification"] = "Movie year cannot be empty\n";//adds error to array if fireExits is blank//
        }
        if (directorFName === "") {
            errors["directorFName"] = "Movie year cannot be empty\n";//adds error to array if fireExits is blank//
        }
        if (directorLName === "") {
            errors["directorLName"] = "Movie year cannot be empty\n";//adds error to array if fireExits is blank//
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
    // define an event listener for the '#editMovieForm'
    //-------------------------------------------------------------------------
    var editMovieForm = document.getElementById('editMovieForm');
    if (editMovieForm !== null) {
        editMovieForm.addEventListener('submit', validateMovieForm);
    }

    //-------------------------------------------------------------------------
    // define an event listener for any '.deleteMovie' links
    //-------------------------------------------------------------------------
    var deleteLinks = document.getElementsByClassName('deleteMovie');
    for (var i = 0; i !== deleteLinks.length; i++) {
        var link = deleteLinks[i];
        link.addEventListener("click", deleteLink);
    }

    function deleteLink(event) {
        if (!confirm("Are you sure you want to delete this movie?")) {
            event.preventDefault();
        }
    }

};
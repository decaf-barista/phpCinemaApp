window.onload = function () {
    //-------------------------------------------------------------------------
    // define an event listener for the '#createReviewForm'
    //-------------------------------------------------------------------------
    var createReviewForm = document.getElementById('createReviewForm');
    if (createReviewForm !== null) {
        createReviewForm.addEventListener('submit', validateReviewForm);
    }

    function validateReviewForm(event) {
        var form = event.target;
        
        var reviewContent = form['reviewContent'].value;

        var spanElements = document.getElementsByClassName("error");//create error variable//
        for (var i = 0; i !== spanElements.length; i++) {//loop for the error variable//
            spanElements[i].innerHTML = "";
        }

        var errors = new Object();

        if (reviewContent === "") {
            errors["reviewContent"] = "Review year cannot be empty\n";//adds error to array if fireExits is blank//
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
    // define an event listener for the '#editReviewForm'
    //-------------------------------------------------------------------------
    var editReviewForm = document.getElementById('editReviewForm');
    if (editReviewForm !== null) {
        editReviewForm.addEventListener('submit', validateReviewForm);
    }

    //-------------------------------------------------------------------------
    // define an event listener for any '.deleteReview' links
    //-------------------------------------------------------------------------
    var deleteLinks = document.getElementsByClassName('deleteReview');
    for (var i = 0; i !== deleteLinks.length; i++) {
        var link = deleteLinks[i];
        link.addEventListener("click", deleteLink);
    }

    function deleteLink(event) {
        if (!confirm("Are you sure you want to delete this review?")) {
            event.preventDefault();
        }
    }

};
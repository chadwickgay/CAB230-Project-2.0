// Colours to be used for input/error confirmation
var successColour = "#66cc66";
var errorColour = "#ff6666";
var noErrorColor = "#ffffff";

function validate() {

    if (checkEmail("createAccount") & checkGender("createAccount") & checkFirstName("createAccount")
        & checkLastName("createAccount") & checkPassword() & checkDOB("createAccount")){
        return true;
    }
    else {
        return false;
    }
}


function checkFirstName(formName) {
    // Format for valid name
    // Allows spaces/hyphen/period as part of name
    validNameFormat = /^[a-zA-Z ,.'\-]+$/;

    //Store the name field objects into variables ...
    var name = document.forms[formName]["first-name"];
    //Store the Error Message Object ...                
    var message = document.getElementById('first-nameErr');

    if (name.value == "") {
        name.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "You must enter a first name!";
        return false;
    } else if (!validNameFormat.test(name.value)) {
        name.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "Enter your first name just using letters!";
        return false;
    } else {
        return true;
    }
}

function checkLastName(formName) {
    // Format for valid name
    // Allows spaces/hyphen/period as part of name
    validNameFormat = /^[a-zA-Z \,\.\'\-]+$/;

    //Store the name field objects into variables ...
    var name = document.forms[formName]["last-name"];
    //Store the Error Message Object ...                
    var message = document.getElementById('last-nameErr');

    if (name.value == "") {
        name.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "You must enter a last name!";
        return false;
    } else if (!validNameFormat.test(name.value)) {
        name.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "Enter your last name just using letters!";
        return false;
    } else {
        return true;
    }
}

function checkEmail(formName) {
    // Format for valid email address
    // Allows letters, numbers, hypens, underscores and periods in address
    // Must have word followed by @ domain name . com
    // Valid example - email@example.com
    var validEmail = /^[a-z][a-zA-Z0-9_.-]*(\.[a-zA-Z][a-zA-Z0-9_.-]*)?@[a-z][a-zA-Z-0-9]*\.[a-z]+(\.[a-z]+)?$/;
    //Store the email field objects into variables ...
    var email = document.forms[formName]["email"];
    //Store the Error Message Object ...                
    var message = document.getElementById('emailErr');

    if (email.value == "") {
        email.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "You must enter an email!";
        return false;
    } else if (!validEmail.test(email.value)) {
        email.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "Email needs to be in the format email@example.com!";
        return false;
    } else {
        return true;
    }
}

function checkDOB(formName) {
    // Format for valid DOB
    // Checks basic format - e.g 01/01/2010 is valid. 
    // Checks number of days in month - e.g. 44/05/2017 is invalid.
    // Checks number of days in month for leaps years.
    validDobFormat = /^(?:(?:31(\/)(?:0?[13578]|1[02]|(?:Jan|Mar|May|Jul|Aug|Oct|Dec)))\1|(?:(?:29|30)(\/)(?:0?[1,3-9]|1[0-2]|(?:Jan|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec))\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/)(?:0?2|(?:Feb))\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/)(?:(?:0?[1-9]|(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep))|(?:1[0-2]|(?:Oct|Nov|Dec)))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/

    // store the DOB field objects into variables
    var dob = document.forms[formName]["dob"];
    // oldest age allowed as valid DOB
    var oldestAge = 123; // oldest age ever recorded
    // current year
    var currentYear = new Date().getFullYear();
    // Store the Error Message Object ...                
    var message = document.getElementById('dobErr');
    // Split date into parts 
    var parts = dob.value.split('/');
    // Retrieve the year entered
    var yearEntered = parts[2];

    // If DOB field empty
    if (dob.value == "") {
        dob.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "You must enter a date of birth!";
        return false;

    } // If DOB does not match valid format
    else if (!validDobFormat.test(dob.value)) {
        dob.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "Date of birth needs to be valid date in the format: dd/mm/yyyy!";
        return false;

    } // If DOB is not within plausible/reasnable range 
    else if (yearEntered < (currentYear - oldestAge || yearEntered > currentYear)) {
        dob.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "Age outside allowed range: " + (currentYear - oldestAge) + " to " +
            currentYear + "!";
        return false;
    } else {
        return true;
    }
}

function checkGender(formName) {
    //Store the gender field objects into variables ...
    var gender = document.forms[formName]["gender"];
    //Store the Error Message Object ...                
    var message = document.getElementById('genderErr');

    if (gender.value == "DEFAULT") {
        message.innerHTML = "You must select a gender!";
        message.style.color = errorColour;
        return false;
    } else {
        return true;
    }

}

function checkPassword() {
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('password1');
    var pass2 = document.getElementById('password2');    
    //Store the Error Message Object ...                
    var message = document.getElementById('passwordErr');

    //Compare the values in the password field 
    //and the confirmation field
    if (pass1.value == "") {
        pass1.style.backgroundColor = errorColour;
        pass2.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "You must enter a password!";
        return false;
    } else if (pass1.value == pass2.value) {
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass1.style.backgroundColor = successColour;
        pass2.style.backgroundColor = successColour;
        message.style.color = successColour;
        message.innerHTML = "Passwords Match!"
        return true;
    } else {
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "Passwords Do Not Match!"
        return false;
    }
}

function resetErrorState(htmlElementName, ErrID, formName) {
    //Store the element name into variable
    var elementName = document.forms[formName][htmlElementName];
    //Store the Error Message Object ...                
    var message = document.getElementById(ErrID);

    elementName.style.backgroundColor = noErrorColor;
    message.style.color = noErrorColor;
    message.innerHTML = "";
}

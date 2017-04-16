// Colours to be used for input/error confirmation
var successColour = "#66cc66";
var errorColour = "#ff6666";
var noErrorColor = "#ffffff";

function validate() {

    return checkEmail() & checkGender() & checkFirstName() & checkLastName() & checkPassword() & checkDOB();

}

function checkFirstName() {
    // Letter format for name
    var justLetters = /^[a-zA-Z]*$/;
    //Store the name field objects into variables ...
    var name = document.forms["myForm"]["first-name"];
    //Store the Confimation Message Object ...                
    var message = document.getElementById('first-nameConfirmMessage');

    if (name.value == "") {
        name.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "You must enter a first name!";
        return false;
    } else if (!justLetters.test(name.value)) {
        name.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "Enter your first name just using letters!";
        return false;
    } else {
        return true;
    }
}

function checkLastName() {
    // Letter format for name
    var justLetters = /^[a-zA-Z]*$/;
    //Store the name field objects into variables ...
    var name = document.forms["myForm"]["last-name"];
    //Store the Confimation Message Object ...                
    var message = document.getElementById('last-nameConfirmMessage');

    if (name.value == "") {
        name.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "You must enter a first name!";
        return false;
    } else if (!justLetters.test(name.value)) {
        name.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "Enter your last name just using letters!";
        return false;
    } else {
        return true;
    }
}

function resetErrorState(htmlElementName, confirmMessageID) {
    //Store the name field objects into variables ...
    var name = document.forms["myForm"][htmlElementName];
    //Store the Confimation Message Object ...                
    var message = document.getElementById(confirmMessageID);

    name.style.backgroundColor = noErrorColor;
    message.style.color = noErrorColor;
    message.innerHTML = "";
}

function checkEmail() {
    // Letter format for name
    var validEmail = /^[a-z][a-zA-Z0-9_.]*(\.[a-zA-Z][a-zA-Z0-9_.]*)?@[a-z][a-zA-Z-0-9]*\.[a-z]+(\.[a-z]+)?$/;
    //Store the name field objects into variables ...
    var email = document.forms["myForm"]["email"];
    //Store the Confimation Message Object ...                
    var message = document.getElementById('emailConfirmMessage');

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

function checkDOB() {
    // Letter format for name
    var validDOB = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;
    //Store the name field objects into variables ...
    var dob = document.forms["myForm"]["dob"];
    //Store the Confimation Message Object ...                
    var message = document.getElementById('dobConfirmMessage');

    if (dob.value == "") {
        dob.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "You must enter a date of birth!";
        return false;
    } else if (!dob.test(dob.value)) {
        email.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "Date of birth needs to be in the format: dd/mm/yyyy";
        return false;
    } else {
        return true;
    }
}

function checkGender() {
    //Store the state field objects into variables ...
    var gender = document.forms["myForm"]["gender"];
    //Store the Confimation Message Object ...                
    var message = document.getElementById('genderConfirmMessage');

    if (gender.value == "DEFAULT") {
        message.innerHTML = "You must select a gender!";
        message.style.color = errorColour;
        return false;
    } else return true;

}

function checkPassword() {
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('password1');
    var pass2 = document.getElementById('password2');    
    //Store the Confimation Message Object ...                
    var message = document.getElementById('passwordConfirmMessage');

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

//With onchange the error message disappears when you have finished typing, whereas with onkeypress it disappears as soon as you enter your first character.

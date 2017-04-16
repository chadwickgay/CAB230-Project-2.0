// Colours to be used for input/error confirmation
var successColour = "#66cc66";
var errorColour = "#ff6666";
var noErrorColor = "#ffffff";

function validate() {

    return checkName() & checkPassword() & checkAddress() & checkEmail() & checkState();

}

function checkName() {
    // Letter format for name
    var justLetters = /^[a-zA-Z]*$/;
    //Store the name field objects into variables ...
    var name = document.forms["myForm"]["surname"];
    //Store the Confimation Message Object ...                
    var message = document.getElementById('surnameConfirmMessage');

    if (name.value == "") {
        name.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "Enter a name!";
        return false;
    } else if (!justLetters.test(name.value)) {
        name.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "Enter your surname just using letters!";
        console.log("not Valid");
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

function checkAddress() {
    // Letter format for name
    var NumbersLettersLetters = /^[\d]+\s[A-z]+\s[A-z]+$/;
    //Store the name field objects into variables ...
    var address = document.forms["myForm"]["address"];
    //Store the Confimation Message Object ...                
    var message = document.getElementById('addressConfirmMessage');

    if (address.value == "") {
        address.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "Enter an address.";
        return false;
    } else if (!NumbersLettersLetters.test(address.value)) {
        address.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "Enter a valid address. Numbers Letters Letters!";
        return false;
    } else {
        return true;
    }
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
        message.innerHTML = "Enter an email!";
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

function checkState() {
    //Store the state field objects into variables ...
    var state = document.forms["myForm"]["state"];
    //Store the Confimation Message Object ...                
    var message = document.getElementById('stateConfirmMessage');

    if (state.value == "DEFAULT") {
        message.innerHTML = "You must select a state!";
        message.style.color = errorColour;
        return false;
    } else return true;

}

function checkPassword() {
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');    
    //Store the Confimation Message Object ...                
    var message = document.getElementById('confirmMessage');

    //Compare the values in the password field 
    //and the confirmation field
    if (pass1.value == "") {
        pass1.style.backgroundColor = errorColour;
        pass2.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "Enter a password!";
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

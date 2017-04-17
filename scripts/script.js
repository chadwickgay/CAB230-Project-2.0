// Colours to be used for input/error confirmation
var successColour = "#66cc66";
var errorColour = "#ff6666";
var noErrorColor = "#ffffff";

function validate() {

    return checkEmail() & checkGender() & checkFirstName() & checkLastName() & checkPassword() & checkDOB();

}

function isNumeric(textToValidate) {
	return /^\d+$/.test(textToValidate);
}

function isAlphabeticOnly(textToValidate) {
	return /^[a-zA-Z\-]+$/.test(textToValidate);
}

//returns the number of valid words in string.
//returns the index (starts from 1) of first invalid word in sentence if any.
function isNumOfWords(textToValidate) {
	var words = textToValidate.split(' ');
	if (textToValidate.length < 1 || words.length < 1) {
		return 0;
	}
	for (var i = 0; i < words.length; i++) {
		if (!isAlphabeticOnly(words[i])) {
			return -1 * (i+1);
		}
	}
	return words.length;
}

function checkFirstName() {
    
    //Store the name field objects into variables ...
    var name = document.forms["myForm"]["first-name"];
    //Store the Confimation Message Object ...                
    var message = document.getElementById('first-nameConfirmMessage');

    if (name.value == "") {
        name.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "You must enter a first name!";
        return false;
	} else if (isNumOfWords(name.value) <= 0) {
        name.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "Enter your first name just using letters!";
        return false;
    } else {
        return true;
    }
}

function checkLastName() {

    //Store the name field objects into variables ...
    var name = document.forms["myForm"]["last-name"];
    //Store the Confimation Message Object ...                
    var message = document.getElementById('last-nameConfirmMessage');

    if (name.value == "") {
        name.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "You must enter a last name!";
        return false;
	} else if (isNumOfWords(name.value) <= 0) {
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

//valid input: d[d]/m[m]/yyyy slashes(/) or dots(.) work.
//must be full year as anything less can be confusing.
//returns the year of birth if valid, else false.
function isValidDate(textToValidate) {
	var parts = textToValidate.split('/');
	if (parts.length != 3) {
		parts = textToValidate.split('.');
	}
	if (parts.length != 3) {
		return false;
	}
	if (parts[2].length != 4 || !isNumeric(parts[2])) {
		return false;
	}
	//months indexing begins at 0.
	//if numbers are negative it goes previous year/month etc.
	//so just a month checks works.
	var date = new Date(parts[2], parts[1] - 1, parts[0]);
	if (date && (date.getMonth() + 1) == parts[1]) {
		return date.getFullYear();
	}
	return false;
}

function checkDOB() {
    //Store the DOB field objects into variables ...
    var dob = document.forms["myForm"]["dob"];
    // oldest age allowed as valid DOB
    var oldestAge = 120;
    // current year
    var currentYear = new Date().getFullYear();
    //Store the Confimation Message Object ...                
    var message = document.getElementById('dobConfirmMessage');

    // If DOB field empty
    if (dob.value == "") {
        dob.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "You must enter a date of birth!";
        return false;
    }
    
    // Check for valid DOB
	var validDob = isValidDate(dob.value);
	
    if (validDob == false) {
		dob.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "Date of birth needs to be in the format: dd/mm/yyyy";
        return false;
	} else if (validDob > (currentYear - oldestAge) && validDob <= currentYear) {
        return true;
    } else {
		dob.style.backgroundColor = errorColour;
        message.style.color = errorColour;
        message.innerHTML = "You must enter a valid date of birth!";
        return false;
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

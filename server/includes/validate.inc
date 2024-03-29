<?php

$error = "";

// Whatever includes this file will have all of these variables set if the POST contains submit
if (isset($_POST['submit'])) {
    $firstName = sanitizeInput($_POST['first-name']);
    $lastName = sanitizeInput($_POST['last-name']);
    $dob = sanitizeInput($_POST['dob']);
    $email = sanitizeInput($_POST['email']);
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['confirm-password'];
    $reviewComment = sanitizeInput($_POST['txtcomment']);
}

### Start of input validation functions ###

// A helper function for returning the POSTed value of a particular variable
function posted_value($name) {
    if (isset($_POST[$name])) {
        return htmlspecialchars($_POST[$name]);
    }
	
    return NULL;
}

// A helper function for validating any firstname input fields
function validateFirstName(&$errors, $field_list, $field_name) {
    $pattern = '/^[a-zA-Z -]+$/';
	
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'First name is required';
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'First name can only be letters, hypens and spaces';
    }
}

// A helper function for validating the review description content
function validateReview(&$errors, $field_list, $field_name) {
    $pattern = '/^[a-zA-Z0-9 :;.,_~\-?!@#\$%\^&\*\(\)]+$/';
	
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'Review comment is required';
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Your comment may not contain special programing characters or quotes!';
    }
}

// A helper function for validating any lastname input fields
function validateLastName(&$errors, $field_list, $field_name) {
    $pattern = '/^[a-zA-Z -]+$/';
	
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'Last name is required';
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Last name can only be letters, hypens and spaces';
    }
}

// A helper function for validating any postcode fields
function validatePostcode(&$errors, $field_list, $field_name) {
    $pattern = '/^[0-9]{4}/';
	
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'Postcode is required';
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Postcode must be a valid Australian format e.g. 4000 or 3000';
    }
}

// A helper function for validating any email fields
function validateEmail(&$errors, $field_list, $field_name) {
    $pattern = '/^[a-z][a-zA-Z0-9_.-]*(\.[a-zA-Z][a-zA-Z0-9_.-]*)?@[a-z][a-zA-Z-0-9]*\.[a-z]+(\.[a-z]+)?$/';
    
	if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'Email address is required';
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Email needs to be in the format email@example.com';
    }
}

// A helper function for ensuring the gender field has been filled
function validateGender(&$errors, $field_list, $field_name) {
    if (!isset($field_list[$field_name]) == 'DEFAULT') {
        $errors[$field_name] = 'Gender is required';
    }
}

// A helper function for validating the date of birth field
function validateDOB(&$errors, $field_list, $field_name) {
    $pattern = '/^(?:(?:31(\/)(?:0?[13578]|1[02]|(?:Jan|Mar|May|Jul|Aug|Oct|Dec)))\1|(?:(?:29|30)(\/)(?:0?[1,3-9]|1[0-2]|(?:Jan|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec))\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/)(?:0?2|(?:Feb))\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/)(?:(?:0?[1-9]|(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep))|(?:1[0-2]|(?:Oct|Nov|Dec)))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/';
    
	if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'Date of birth is required';
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Date of birth needs to be in the format dd/mm/yyyy';
    }
}

// A helper function for validating the password input field
function validateLoginPassword(&$errors, $field_list, $password) {
    if (!isset($field_list[$password]) || empty($field_list[$password])) {
        $errors[$password] = 'Password is required';
    }
}

// A helper function for ensuring that only valid passwords can be created
function validateCreatePassword(&$errors, $field_list, $password, $passwordConfirm) {
    if (!isset($field_list[$password]) || empty($field_list[$password]) || !isset($field_list[$passwordConfirm]) || empty($field_list[$passwordConfirm])) {
        $errors[$password] = 'Password & Confirm Password are required';
    } else if (strcmp($field_list[$password], $field_list[$passwordConfirm]) != 0) {
        $errors[$password] = 'Password & Confirm Password must match';
    }
}

// A helper method used to santize user input to prevent XSS
function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

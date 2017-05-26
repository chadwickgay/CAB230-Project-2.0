<?php

$error = ""; // Initialize error as blank

if (isset($_POST['submit'])) { // check if the form is submitted

    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $dob = trim($_POST['dob']);
    $email = trim($_POST['email']);
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
}

### Start of input validation functions ###

function validateFieldNotEmpty(&$errors, $field_list, $field_name) {
	if (!isset($field_list[$field_name]) || empty($field_list[$field_name]) || $field_list[$field_name] == 'NULL') {
		$errors[$field_name] = 'required';
		return false;
	}
	return true;
}

function validateFirstName(&$errors, $field_list, $field_name) {
    $pattern = '/^[a-zA-Z -]+$/';
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'First name is required';
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'First name can only be letters, hypens and spaces';
    }
}

function validateReview(&$errors, $field_list, $field_name) {
    $pattern = '/^[a-zA-Z0-9 -]+$/';
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'Review comment is required';
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Review comment can only be letters, numbers, hypens and spaces';
    }
}

function validateLastName(&$errors, $field_list, $field_name) {
    $pattern = '/^[a-zA-Z -]+$/';
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'Last name is required';
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Last name can only be letters, hypens and spaces';
    }
}

function validateEmail(&$errors, $field_list, $field_name) {
    $pattern = '/^[a-z][a-zA-Z0-9_.-]*(\.[a-zA-Z][a-zA-Z0-9_.-]*)?@[a-z][a-zA-Z-0-9]*\.[a-z]+(\.[a-z]+)?$/';
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'Email address is required';
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Email needs to be in the format email@example.com';
    }
}

function validateGender(&$errors, $field_list, $field_name) {

    if (!isset($field_list[$field_name]) == 'DEFAULT') {
        $errors[$field_name] = 'Gender is required';

    }
}

function validateDOB(&$errors, $field_list, $field_name) {
    $pattern = '/^(?:(?:31(\/)(?:0?[13578]|1[02]|(?:Jan|Mar|May|Jul|Aug|Oct|Dec)))\1|(?:(?:29|30)(\/)(?:0?[1,3-9]|1[0-2]|(?:Jan|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec))\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/)(?:0?2|(?:Feb))\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/)(?:(?:0?[1-9]|(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep))|(?:1[0-2]|(?:Oct|Nov|Dec)))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/';
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'Date of birth is required';
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Date of birth needs to be in the format dd/mm/yyyy';
    }
}

function validatePassword(&$errors, $field_list, $field_name) {
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'Password is required';
}
}

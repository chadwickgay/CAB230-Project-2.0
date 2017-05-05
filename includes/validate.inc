<?php

$error = ""; // Initialize error as blank

if (isset($_POST['submit'])) { // check if the form is submitted

    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $dob = trim($_POST['dob']);
    $email = trim($_POST['email']);
    $gender	= $_POST['gender'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
}

### Start of input validation functions ###

function validateEmail(&$errors, $field_list, $field_name) {
    $pattern = '/^[a-z][a-zA-Z0-9_.-]*(\.[a-zA-Z][a-zA-Z0-9_.-]*)?@[a-z][a-zA-Z-0-9]*\.[a-z]+(\.[a-z]+)?$/';
    if (!isset($field_list[$field_name])|| empty($field_list[$field_name])) {
        $errors[$field_name] = 'Email address is required';
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Email needs to be in the format email@example.com';
    }
}

function validateFirstName(&$errors, $field_list, $field_name) {
    $pattern = '/^[a-zA-Z -]+$/';
    if (!isset($field_list[$field_name])|| empty($field_list[$field_name])) {
        $errors[$field_name] = 'First Name is required';
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'First Name can only be letters, hypens and spaces';
    }
}

function validateLastName(&$errors, $field_list, $field_name) {
    $pattern = '/^[a-zA-Z -]+$/';
    if (!isset($field_list[$field_name])|| empty($field_list[$field_name])) {
        $errors[$field_name] = 'Last Name is required';
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Last Name can only be letters, hypens and spaces';
    }
}


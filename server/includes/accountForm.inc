<form name="createAccount" method="POST" action="create-account.php">
    <div class="row">
        <div class="two columns">
			<?php

            $genderOptions = array("Undisclosed", "Male", "Female", "Other");

            createInputField('text', 'John', 'first-name', 'first-name', 'First Name', 'first-nameErr', 'createAccount');
            createInputField('text', 'Smith', 'last-name', 'last-name', 'Last Name', 'last-nameErr', 'createAccount');
            createInputField('text', 'dd/mm/yyyy', 'dob', 'dob', 'Date of Birth (dd/mm/yyyy)', 'dobErr', 'createAccount');
            createInputField('text', 'Postcode', 'postcode', 'postcode', 'Postcode', 'postcodeErr', 'createAccount');




			?>
        </div>

        <div class="two columns">
			<?php
            createSelectField('gender', 'Gender', 'gender', 'genderErr', $genderOptions, 'createAccount');
            createInputField('text', 'email@example.com', 'email', 'email', 'Email', 'emailErr', 'createAccount');
            createInputField('password', 'password', 'password', 'password1', 'Password', 'passwordErr', 'createAccount');
            createInputField('password', 'confirm password', 'confirm-password', 'password2', 'Confirm Password', 'confirmPasswordErr', 'createAccount');
            ?>



        </div>
    </div>
	
    <div class="row">
        <div class="one column">
            <input name="register" type="submit" value="Submit" onclick="return validateCreateAccount()">
        </div>
    </div>
</form>

<div class="one column">
    <p class="message">Already registered? <a href="login.php">Sign In</a></p>
</div>
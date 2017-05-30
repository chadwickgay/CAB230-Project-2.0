<!-- Generate form opening tags for create account form -->
<?php createFormOpeningTag("POST", "create-account.php", "createAccount", ""); ?>
    <div class="row">
        <div class="two columns">
            <?php
            // Generate first name field
            createInputField('text', 'John', 'first-name', 'first-name', 'First Name', 'first-nameErr', 'createAccount');

            // Generate last name field
            createInputField('text', 'Smith', 'last-name', 'last-name', 'Last Name', 'last-nameErr', 'createAccount');

            // Generate dob field
            createInputField('text', 'dd/mm/yyyy', 'dob', 'dob', 'Date of Birth (dd/mm/yyyy)', 'dobErr', 'createAccount');

            // Generate postode field
            createInputField('text', 'Postcode', 'postcode', 'postcode', 'Postcode', 'postcodeErr', 'createAccount');
            ?>
        </div>

        <div class="two columns">
            <?php

            // Array of possible gender options - used by gender dropdown
            $genderOptions = array("Undisclosed", "Male", "Female", "Other");

            // Generate gender dropdown
            createSelectField('gender', 'Gender', 'gender', 'genderErr', $genderOptions, 'createAccount');

            // Generate email field with
            createInputField('text', 'email@example.com', 'email', 'email', 'Email', 'emailErr', 'createAccount');

            // Generate password field
            createInputField('password', 'password', 'password', 'password1', 'Password', 'passwordErr', 'createAccount');

            // Generate confirm password field
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
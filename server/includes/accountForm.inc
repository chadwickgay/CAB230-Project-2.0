<form name="createAccount" method="POST" action="create-account.php">
    <div class="row">
        <div class="two columns">
			<?php 
				createInputField("text", "", "first-name", "First Name", "John", "first-nameErr", "createAccount");
				createInputField("text", "", "last-name", "Last Name", "Smith", "last-nameErr", "createAccount");
				createInputField("text", "", "dob", "Date of Birth (dd/mm/yyyy)", "dd/mm/yyyy", "dobErr", "createAccount");
				createInputField("text", "", "email", "Email", "johnsmith@example.com", "emailErr", "createAccount"); 
			?>
        </div>

        <div class="two columns">
			<?php 
				createSelectField("gender", "gender-select", "gender", "Gender", ["Male", "Female", "Other", "Undisclosed"], ["1", "2", "3", "0"], "select", "genderErr");
				createInputField("password", "password1", "password", "Password", "password", "passwordErr", "createAccount"); 
				createInputField("password", "password2", "password", "Confirm Password", "confirm password", "passwordErr", "createAccount");
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
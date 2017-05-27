<form name="createAccount" method="POST" action="create-account.php">
    <div class="row">
        <div class="two columns">
			<?php createInputField("text", "first-name", "First Name", "first-nameErr", "createAccount"); ?>
			
			<?php createLabel("last-name", "Last Name"); ?>
            <input type="text" placeholder="Smith" name="last-name" id="last-name"
                   <?php createPostedValue("last-name"); ?>
                   onkeypress="resetErrorState('last-name', 'last-nameErr', 'createAccount')"/>
            <br>
			<?php createErrorLabel("last-nameErr"); ?>
			
			<?php createLabel("dob", "Date of Birth (dd/mm/yyyy)"); ?>
            <input type="text" name="dob" id="dob" placeholder="dd/mm/yyyy"
                   <?php createPostedValue("dob"); ?>
                   onkeypress="resetErrorState('dob', 'dobErr', 'createAccount')"/>
            <br>
			<?php createErrorLabel("dobErr"); ?>

			<?php createLabel("email", "Email"); ?>
            <input type="text" name="email" id="email" placeholder="email@example.com"
                   <?php createPostedValue("email"); ?>
                   onkeypress="resetErrorState('email', 'emailErr', 'createAccount')"/>
            <br>
			<?php createErrorLabel("emailErr"); ?>
        </div>

        <div class="two columns">
			<?php createLabel("gender", "Gender"); ?>
            <select class="gender-select" name="gender" id="gender">
                <option selected value="DEFAULT" disabled style="display: none;">select</option>
                <option <?php echo posted_value('gender') == 1 ? 'selected' : '' ?> value="1">Male</option>
                <option <?php echo posted_value('gender') == 2 ? 'selected' : '' ?> value="2">Female</option>
                <option <?php echo posted_value('gender') == 3 ? 'selected' : '' ?> value="3">Other</option>
                <option <?php echo posted_value('gender') === 0 ? 'selected' : '' ?> value="0">Undisclosed</option>
            </select>
            <br>
			<?php createErrorLabel("genderErr"); ?>
			
			<?php createLabel("password1", "Password"); ?>
            <input type="password" name="password" id="password1" placeholder="password"
                   onkeypress="resetErrorState('password', 'passwordErr', 'createAccount');
                   resetErrorState('confirm-password', 'passwordErr', 'createAccount') "/>
            <br>
            <input type="password" name="confirm-password" id="password2" placeholder="confirm password"
                   onkeypress="resetErrorState('password', 'passwordErr', 'createAccount');
                   resetErrorState('confirm-password', 'passwordErr', 'createAccount') "/>
            <br>
			<?php createErrorLabel("passwordErr"); ?>
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
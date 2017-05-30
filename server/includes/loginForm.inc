<!-- Generate form opening tags for login form -->
<?php createFormOpeningTag("POST", "login.php", "login", "return validateLogin();"); ?>
    <div class="row">
        <div class="two columns">
            <!-- Generate email field -->
            <?php createInputField('text', 'email@example.com', 'email', 'email', 'Email', 'emailErr', 'login'); ?>
        </div>
		
        <div class="two columns">
            <!-- Generate password field -->
            <?php createInputField('password', 'password', 'password', 'password', 'Password', 'passwordErr', 'login'); ?>
        </div>
    </div>

    <div class="one column">
        <input type="submit" value="Submit" onclick="return validateLogin()">
    </div>
</form>

<p class="message">Not registered? <a href="create-account.php">Create an account</a></p>

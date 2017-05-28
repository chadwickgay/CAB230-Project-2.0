<form method="POST" action="login.php" name="login" onsubmit="return validateLogin();">
    <div class="row">
        <div class="two columns">
            <label for="email">Email</label>
            <input name="email" type="text" id="email" placeholder="email@example.com"
                   value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"
                   onkeypress="resetErrorState('email', 'emailErr', 'login')"/>
            <br>
            <span id="emailErr"></span>
        </div>

        <div class="two columns">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="password"
                   onkeypress="resetErrorState('password', 'passwordErr', 'login')"/>
            <br>
            <span id="passwordErr"></span>
        </div>
    </div>

    <div class="one column">
        <input type="submit" value="Submit">

    </div>
</form>

<p class="message">Not registered? <a href="create-account.php">Create an account</a></p>
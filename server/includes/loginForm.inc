<form method="POST" action="login.php" name="login">
    <div class="row">
        <div class="two columns">
            <label for="email">Email</label>
            <input name="email" type="text" id="email" placeholder="email@example.com" onkeypress="resetErrorState('email', 'emailErr', 'login')" />
            <br>
            <span id="emailErr"></span>
        </div>

        <div class="two columns">
            <label for="gender">Password</label>
            <input type="password" id="password" placeholder="password" />
        </div>
    </div>

    <div class="one column">
        <input type="submit" value="Submit" onclick="return validateLogin()">

    </div>
</form>

<p class="message">Not registered? <a href="create-account.php">Create an account</a></p>
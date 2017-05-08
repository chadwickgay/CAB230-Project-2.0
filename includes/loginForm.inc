<form method="POST" name="login">
    <div class="row">
        <div class="two columns">
            <label for="email">Email</label>
            <input name="email" type="text" id="email" placeholder="email@example.com" />
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
        <p class="message">Not registered? <a href="create-account.html">Create an account</a></p>
    </div>
</form>
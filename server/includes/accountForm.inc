<form name="createAccount" method="POST" action="create-account.php">
    <div class="row">
        <div class="two columns">
            <label for="first-name">First Name</label>
            <input type="text" placeholder="John" name="first-name" id="first-name" value="<?php= $_POST['first-name'] ?? ''; ?>" onkeypress="resetErrorState('first-name', 'first-nameErr', 'createAccount')" />
            <br>
            <span id="first-nameErr"></span>

            <label for="last-name">Last Name</label>
            <input type="text" placeholder="Smith" name="last-name" id="last-name" value="<?php= $_POST['last-name'] ?? ''; ?>" onkeypress="resetErrorState('last-name', 'last-nameErr', 'createAccount')" />
            <br>
            <span id="last-nameErr"></span>

            <label for="dob">Date of Birth (dd/mm/yyyy)</label>
            <input type="text" name="dob" id="dob" placeholder="dd/mm/yyyy" value="<?php= $_POST['dob'] ?? ''; ?>" onkeypress="resetErrorState('dob', 'dobErr', 'createAccount')" />
            <br>
            <span id="dobErr"></span>

            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="email@example.com" onkeypress="resetErrorState('email', 'emailErr', 'createAccount')" />
            <!-- NEED TO REPOPULATE -->
            <br>
            <span id="emailErr"></span>

        </div>

        <div class="two columns">
            <label for="gender">Gender</label>
            <select class="gender-select" name="gender" id="gender">
                <option value="DEFAULT" disabled selected style="display: none;">select</option>
                <option value="m">Male</option>
                <option value="f">Female</option>
                <option value="o">Other</option>
                <option value="u">Undisclosed</option>
            </select>
            <br>
            <span id="genderErr"></span>

            <label for="password1">Password</label>
            <input type="password" name="password" id="password1" placeholder="password" onkeypress="resetErrorState('password', 'passwordErr', 'createAccount')" />
            <br>

            <input type="password" name="confirm-password" id="password2" placeholder="confirm password" onkeypress="resetErrorState('confirm-password', 'passwordErr', 'createAccount')" />
            <br>
            <span id="passwordErr"></span>

            <br>
            <input type="checkbox" name="subscribe" value="subscribe">Subscribe to the weekly Park Search newsletter to receive
            <br>the latest updates about your favourite parks.
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
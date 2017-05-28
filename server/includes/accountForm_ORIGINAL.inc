<form name="createAccount" method="POST" action="create-account.php">
    <div class="row">
        <div class="two columns">
            <label for="first-name">First Name</label>
			<input type="text" placeholder="John" name="first-name" id="first-name"
                   value="<?php echo isset($_POST['first-name']) ? $_POST['first-name'] : ''; ?>"
                   onkeypress="resetErrorState('first-name', 'first-nameErr', 'createAccount')"/>
            <br>
            <span id="first-nameErr"></span>

            <label for="last-name">Last Name</label>
            <input type="text" placeholder="Smith" name="last-name" id="last-name"
                   value="<?php echo isset($_POST['last-name']) ? $_POST['last-name'] : ''; ?>"
                   onkeypress="resetErrorState('last-name', 'last-nameErr', 'createAccount')"/>
            <br>
            <span id="last-nameErr"></span>

            <label for="dob">Date of Birth (dd/mm/yyyy)</label>
            <input type="text" name="dob" id="dob" placeholder="dd/mm/yyyy"
                   value="<?php echo isset($_POST['dob']) ? $_POST['dob'] : ''; ?>"
                   onkeypress="resetErrorState('dob', 'dobErr', 'createAccount')"/>
            <br>
            <span id="dobErr"></span>

            <label for="postcode">Postcode</label>
            <input type="text" placeholder="Postcode" name="postcode" id="postcode"
                   value="<?php echo isset($_POST['postcode']) ? $_POST['postcode'] : ''; ?>"
                   onkeypress="resetErrorState('postcode', 'postcodeErr', 'createAccount')"/>
            <br>
            <span id="postcode"></span>

            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="email@example.com"
                   value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"
                   onkeypress="resetErrorState('email', 'emailErr', 'createAccount')"/>

            <br>
            <span id="emailErr"></span>

        </div>

        <div class="two columns">
            <label for="gender">Gender</label>
            <select name="gender" id="gender">
                <option selected value="DEFAULT" class="hidden">select</option>
                <option <?php echo posted_value('gender') == 1 ? 'selected' : '' ?> value="1">Male</option>
                <option <?php echo posted_value('gender') == 2 ? 'selected' : '' ?> value="2">Female</option>
                <option <?php echo posted_value('gender') == 3 ? 'selected' : '' ?> value="3">Other</option>
                <option <?php echo posted_value('gender') === 0 ? 'selected' : '' ?> value="0">Undisclosed</option>
            </select>
            <br>
            <span id="genderErr"></span>

            <label for="password1">Password</label>
            <input type="password" name="password" id="password1" placeholder="password"
                   onkeypress="resetErrorState('password', 'passwordErr', 'createAccount')"/>
            <br>

            <input type="password" name="confirm-password" id="password2" placeholder="confirm password"
                   onkeypress="resetErrorState('confirm-password', 'passwordErr', 'createAccount')"/>
            <br>
            <span id="passwordErr"></span>

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

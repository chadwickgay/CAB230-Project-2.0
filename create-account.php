<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Park Search - Create Account Page</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'>

    <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- JS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <script type="text/javascript" src="scripts/script.js"></script>


</head>

<body>

    <div class="container">

        <!-- Page Header
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <header>
            <div class="header">
                <!-- FIX THIS -->
                <h1>Park Search</h1>
                <?php include('includes/nav.inc'); ?>
            </div>
        </header>

        <!-- Main Content
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <h3>Create an account</h3>

        <form name="myForm" method="get">
            <div class="row">
                <div class="two columns">
                    <label for="first-name">First Name</label>
                    <input type="text" placeholder="John" name="first-name" id="first-name" onkeypress="resetErrorState('first-name', 'first-nameConfirmMessage')" />
                    <br>
                    <span id="first-nameConfirmMessage"></span>


                    <label for="last-name">Last Name</label>
                    <input type="text" placeholder="Citizen" name="last-name" id="last-name" onkeypress="resetErrorState('last-name', 'last-nameConfirmMessage')" />
                    <br>
                    <span id="last-nameConfirmMessage"></span>

                    <label for="dob">Date of Birth (dd/mm/yyyy)</label>
                    <input type="text" name="dob" id="dob" placeholder="dd/mm/yyyy" onkeypress="resetErrorState('dob', 'dobConfirmMessage')"/>
                    <br>
                    <span id="dobConfirmMessage"></span>

                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="email@example.com" onkeypress="resetErrorState('email', 'emailConfirmMessage')" />
                    <br>
                    <span id="emailConfirmMessage"></span>

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
                    <span id="genderConfirmMessage"></span>

                    <label for="password1">Password</label>
                    <input type="password" name="password" id="password1" placeholder="password" onkeypress="resetErrorState('password', 'passwordConfirmMessage')" />
                    <br>

                    <input type="password" name="confirm-password" id="password2" placeholder="confirm password" onkeypress="resetErrorState('confirm-password', 'passwordConfirmMessage')" />
                    <br>
                    <span id="passwordConfirmMessage"></span>

                    <br>
                    <input type="checkbox" name="subscribe" value="subscribe">Subscribe to the weekly Park Search newsletter to receive
                    <br>the latest updates about your favourite parks.
                </div>
            </div>

            <div class="one column">
                <input type="button" onclick="validate()" value="Submit">
                <p class="message">Already registered? <a href="login.html">Sign In</a></p>
            </div>


        </form>


        <!-- Footer
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <footer class="one column">
            <p>Copyright &copy; Chadwick Gay | Tom Deakin | Kenneth Koefler</p>
        </footer>


        <!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    </div>


</body>

</html>

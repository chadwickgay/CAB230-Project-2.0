<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Park Search - Login Page</title>
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

</head>

<body>

    <div class="container">

        <!-- Page Navigation
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <?php include('includes/nav.inc'); ?>

        <!-- Main Content
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <h3>Sign into existing account</h3>

        <form method="POST">
            <div class="row">
                <div class="two columns">
                    <label for="email">Email</label>
                    <input type="text" id="email" placeholder="email address" />
                </div>

                <div class="two columns">
                    <label for="gender">Password</label>
                    <input type="password" id="gender" placeholder="password" />
                </div>
            </div>

            <div class="one column">
                <input type="submit" value="Submit">
                <p class="message">Not registered? <a href="create-account.html">Create an account</a></p>
            </div>
        </form>


        <!-- Footer
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <?php include('includes/footer.inc'); ?>

        <!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    </div>


</body>

</html>

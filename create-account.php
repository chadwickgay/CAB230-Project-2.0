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

    <!-- Page Navigation
–––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <?php include('includes/nav.inc'); ?>

    <!-- Main Content
–––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <h3>Create an account</h3>

    <?php include('includes/createAccountForm.inc'); ?>

    <div class="one column">
        <input type="button" onclick="validate()" value="Submit">
        <p class="message">Already registered? <a href="login.html">Sign In</a></p>
    </div>

    <!-- Footer
–––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <?php include('includes/footer.inc'); ?>


    <!-- End Document
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
</div>


</body>

</html>

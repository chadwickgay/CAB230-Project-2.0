<header>
    <div class="header">
        <h1>Park Search</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="browse.php">Browse</a></li>
                <?php
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
				
                if (isset($_SESSION['logged'])) {
                    echo "<li><a href='logout.php'>Logout</a></li>";
                } else {
                    echo "<li><a href='create-account.php'>Create Account</a></li>";
                    echo "<li><a href='login.php'>Login</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>
</header>

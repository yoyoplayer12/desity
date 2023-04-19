<nav>
    <img class="navlogo" src="assets/brand/logo-horizontal.svg" alt="Copoll logo" style="height: 48px;">
    <ul>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="login.php"><?php
        if (isset($_SESSION["firstname"])) {
            echo "Dashboard";
        }
        else{
            echo "Log in";
        }
        ?></a></li>
    </ul>
</nav>
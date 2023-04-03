<nav>
    <ul>
        <li><h1>CoPoll</h1></li>
        <li><a href="index.php"><h1>Posts</h1></a></li>
        <!-- residents section -->
        <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] === true): ?>
            <li><a href="residents.php"><h1>Residents</h1></a></li>
        <?php endif; ?>
        <li><a href="login.php"><h1><?php
        if (isset($_SESSION["firstname"])) {
            echo $_SESSION["firstname"] . " " . $_SESSION["lastname"];
        }
        else{
            echo "Log in";
        }
        ?></h1></a></li>
    </ul>
</nav>
<nav>
    <ul>
        <li><h1>CoPoll</h1></li>
        <li><a href="index.php"><h1>Home</h1></a></li>
        <li><a href="#"><h1>Mechelen</h1></a></li>
        <li><a href="login.php"><h1><?php
        if ($_SESSION["firstname"]==null) {
            echo "Log in";
        }
        else{
            echo $_SESSION["firstname"] . " " . $_SESSION["lastname"];
        }
        ?></h1></a></li>
    </ul>
</nav>
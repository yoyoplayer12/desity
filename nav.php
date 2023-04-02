<nav>
    <ul>
        <li><h1>CoPoll</h1></li>
        <li><a href="index.php"><h1>Home</h1></a></li>
        <li><a href="#"><h1>Mechelen</h1></a></li>
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
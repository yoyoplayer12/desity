<?php
    include_once(__DIR__ . "/bootstrap.php");
    include_once(__DIR__ . "/loginCheck.php");
    if($_SESSION['loggedin'] === true) {
        header("Location: ./account.php");  
    }
    else{
        if(!empty($_POST)){
            //er is gesubmit
            $email = $_POST['email'];
            $password = $_POST['password'];
            if(canLogin($email, $password)){
                $_SESSION['loggedin'] = true;
                header("Location: ./index.php");
            }
            else {
                echo "Wrong password or username";
            }
        }
      }
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Copoll - Log in</title>
</head>
<body>
    <?php include_once(__DIR__ . "/nav.php"); ?>

    <div class="loginform">
        <form action="" method="post">
            <h1>Log in</h1>
            <ul>
                <li><input type="text" name="email" placeholder="Email" required></li>
                <li><input type="password" name="password" placeholder="Password" required></li>
                <li><input type="submit" value="Log in"></li>
                <li><a href="register.php">Create an account</a></li>
            </ul>
        </form>
    </div>

</body>
</html>

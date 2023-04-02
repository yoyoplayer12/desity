<?php 
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    if($_SESSION['loggedin'] === true) {
      }
    else{
        header("Location: ./login.php");
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
    <title>Copoll - Account</title>
</head>
<body>
    <?php include_once(__DIR__ . "/nav.php"); ?>
    <h1>Name: <?php echo $_SESSION["firstname"]?></h1>
    <h1>Last name: <?php echo $_SESSION["lastname"]?></h1>
    <h1>Email: <?php echo $_SESSION["email"]?></h1>
    <h1>Place of residency: <?php echo $_SESSION["place"]?></h1>
    <a href="logout.php">Log out</a>
</body>
</html>

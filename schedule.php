<?php
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    if(isset($_SESSION["loggedin"])) {
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
    <link rel="icon" href="assets/brand/tabicon.svg" style="height:40px" type="image/svg">
    <title>Dashboard - Schedule</title>
</head>
<body>
    <?php include_once(__DIR__ . "/navs/dashnav.php"); ?>
   
</body>
</html>
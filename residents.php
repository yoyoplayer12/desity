<?php 
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    if(isset($_SESSION["loggedin"]) && $_SESSION["admin"] == 1) {
        $allResidents = Resident::getResident($_SESSION["placeid"]);
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
    <title>Copoll - Residents</title>
</head>
<body>
    <?php include_once(__DIR__ . "/nav.php"); ?>
    <h1 class="residenttitle">Residents of <?php echo $_SESSION["place"]; ?></h1>
    <?php foreach($allResidents as $resident): ?>
        <div class="resident">
            <img class="resident-avatar" src="<?php echo $resident["photo_url"]?>" alt="Avatar">
            <h1>Name: <?php echo $resident["firstname"] . " " . $resident["lastname"]?></h1>
            <h1>Email: <?php echo $resident["email"]?></h1>
        </div>
    <?php endforeach; ?>
</body>
</html>

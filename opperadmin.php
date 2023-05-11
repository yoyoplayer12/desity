<?php
    include_once(__DIR__ . "/bootstrap.php");
    include_once(__DIR__ . "/loginCheck.php");
    if (isset($_SESSION["loggedin"])) {
        if ($_SESSION["opperadmin"] == 1){
            
        }
        else{
            header("Location: ./dashboard.php");
        }
    }
    else{
        header("Location: ./login.php");
    }
    $allCitygroups = [];
    $allCitygroups = City::getAllCitygroups();
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
    <script src="JavaScript/carrousel.js" defer></script>
    <title>Copoll - Opper Admin</title>
</head>
<body>
    <?php include_once(__DIR__ . "/navs/dashnav.php"); ?>
    <h1 style="text-align: center; margin-top:0;padding-top:40px;">Opperadmin panel</h1>
    <?php foreach($allCitygroups as $citygroup): ?> 
        <div style="margin-left: 300px;margin-bottom: 100px;border-bottom:1px solid black;">
        <?php $allcities = City::getCityByGroup($citygroup['id']); ?>
            <h2><?php echo $citygroup['name'] ?></h2>
            <div style="margin-left: 100px;">
                <h3>City:</h3>
                <?php foreach($allcities as $city): ?>
                    <ul>
                        <li><?php echo $city['city'] ?></li>
                    </ul>
                <?php endforeach; ?>
            </div>
            
        </div>
    <?php endforeach; ?>
</body>
</html>

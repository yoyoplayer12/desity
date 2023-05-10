<?php
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="assets/brand/Logo-favicon-white.svg" style="height:40px" type="image/svg+xml">
    <title>Copoll</title>
</head>
<body>
    <?php include_once(__DIR__ . "/navs/dashnav.php"); ?>
    <div class="projectcontent">
        <div class="projecttop">
            <h4>Open projects</h4>
           
        </div>
       

        <div class="bottom-section">
            <div class="ongoingpolls-container">
                <div class="ongoing-polls">
                    <h4>Ongoing polls</h4>
                   
                </div>
            </div>
           
            <div class="recentannouncements-container">
                <div class="recent-announcements">
                    <h4>Recent announcements</h4>
                 
                </div>
            </div>
            
        </div>
        
    </div>
</body>
</html>
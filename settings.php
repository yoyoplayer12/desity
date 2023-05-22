<?php
    // ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    if(isset($_SESSION["loggedin"]) && isset($_SESSION['admin'])){
        if($_SESSION['admin'] == 1){
            
        }
        else{
            header("Location: ./dashboard.php");
        }
    }
    else{
        header("Location: ./login.php");
    }
    $image = new Image();
    $url = $image->getUrl()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="<?php echo $url."assets/brand/ppyo2h0le7ysvsembls6" ?>" style="height:40px" type="image/svg">
    <title>Copoll - Settings</title>
</head>
<body>
    <?php include_once(__DIR__ . "/navs/dashnav.php"); ?>
</body>
</html>
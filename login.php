<?php
    include_once(__DIR__ . "/bootstrap.php");
    include_once(__DIR__ . "/loginCheck.php");
    $loginwarning = "";
    $allCities = [];
    $allCities = City::getCity();
    if (isset($_SESSION["loggedin"])) {
        header("Location: ./dashboard.php");
    }
    if(!empty($_POST)){
        if(isset($_POST['email']) && isset($_POST['password'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            if(canLogin($email, $password)){
                $_SESSION['loggedin'] = true;
                header("Location: ./dashboard.php");
            }
            else {
                $loginwarning = "Wrong password or username";
            }
        }
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
    <link rel="icon" href="assets/brand/tabicon.svg" style="height:40px" type="image/svg">
    <script src="JavaScript/carrousel.js" defer></script>
    <title>Copoll - Sign in</title>
</head>
<body>
    <?php include_once(__DIR__ . "/navs/nav.php"); ?>
    <div class="signupform">
        <div class="signupform-container-input">
            <form action="" method="post" enctype="multipart/form-data"> 
                <h1 style="margin: 0;">Sign in</h1>
                <p class="loginbuttontext-register">Don't have an account yet? <a class="loginbutton-register" href="register.php">Create an account</a></p>
                <ul class="mainform-register">
                    <li><input class="form-grid-item-register-2-2" type="text" name="email" placeholder="Email adress"></li>
                    <li><input class="form-grid-item-register-2-2" type="password" name="password" placeholder="Password"></li>
                    <div class="form-grid-container-register-left" style="margin-top: 36px">
                        <li class="form-grid-item-register-1-2"><input class="button-large-left" type="submit" name="" value="FORGOT PASSWORD?" id="charcoal"></li>
                        <li class="form-grid-item-register-1-2"><input class="button-large-right" type="submit" name="login" value="LOG IN >"></li>
                    </div>
                    <li class="warningtext"><?php echo $loginwarning ?></li>
                </ul>
            </form>
        </div>
        <div class="signupform-container-img">
            <div class="gradientcitypic" style="max-width:44vw"></div>
            <div class="w3-content w3-section" style="max-width:44vw; overflow:hidden;">
                <?php foreach($allCities as $city): ?>
                    <img class="mySlides" src="<?php echo $url.$city['city-pic'] ?>">
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    // ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    $emailwarning = " ";
    $user = new User();
    $allCities = [];
    $allCities = City::getCity();
    if(isset($_SESSION['loggedin'])){
        header("Location: ./dashboard.php");
    }
    if(isset($_POST['next'])){
        $_SESSION['basisinfo'] = 1;
        $_SESSION['firstname-login'] = $_POST['firstname'];
        $_SESSION['lastname-login'] = $_POST['lastname'];
        $_SESSION['email-login'] = $_POST['email'];
        $_SESSION['place-login'] = $_POST['city'];
        $city = City::getCityById($_POST['city']);
        $_SESSION['citygroupid'] = $city['citygroup_id'];
        $_SESSION['adress-login'] = $_POST['adress'];
        $_SESSION['password-login'] = $_POST['password'];
        $_SESSION['dob-login'] = $_POST['date'];
        $user->setEmail($_POST['email']);
        if($user->getUser() === false){
            header("Location: ./register-photo.php");
        }
        else{
            $emailwarning = "This email is already in use";
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
    <link rel="icon" href="<?php echo $url."assets/brand/ppyo2h0le7ysvsembls6" ?>" style="height:40px" type="image/svg">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="JavaScript/carrousel.js" defer></script>
    <title>Copoll - Create an account</title>
</head>
<body>
    <?php include_once(__DIR__ . "/navs/nav.php"); ?>
    <!-- register form -->
    <div class="signupform">
        <div class="signupform-container-input">
            <form action="" name="next" method="post" enctype="multipart/form-data">
                <h5>GET STARTED</h5>    
                <h1 style="margin: 0;">Create an account</h1>
                <p class="loginbuttontext-register">Already have an account? <a class="loginbutton-register" href="login.php">Log in</a></p>
                <ul class="mainform-register">
                    <div class="form-grid-container-register-left">
                        <li class="form-grid-item-register-1-2"><input type="text" name="firstname" placeholder="First name" required></li>
                        <li class="form-grid-item-register-1-2"><input type="text" name="lastname" placeholder="Last name" required></li>
                    </div>
                    <li><input class="form-grid-item-register-2-2" type="email" name="email" id="email" onkeyup="checkEmailAvailability()" placeholder="Email" required></li>
                    <li><input type="date" name="date" id="date" placeholder="date of birth" class="form-grid-item-register-2-2" required></li>
                    <div class="form-grid-container-register-left">
                        <select name="city" id="city" class="dropdown-register" required>
                            <option value="" disabled selected>Select City</option>
                            <?php foreach($allCities as $city): ?>
                                <option value="<?php echo $city['id']; ?>"><?php echo $city['city']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <li class="form-grid-item-register-1-2"><input type="text" name="adress" placeholder="Street, number" required></li>
                    </div>        
                    <li><input class="form-grid-item-register-2-2" type="password" name="password" placeholder="Password" required></li>
                    <li><input class="form-grid-item-register-2-2" type="password" name="password-repeat" placeholder="Repeat password" required></li>
                    <div class="form-grid-container-register-left" style="margin-top: 36px">
                        <li class="form-grid-item-register-1-2"><input type="button" value="" name="" class="button-large-right"></li>
                        <li class="form-grid-item-register-1-2"><input type="submit" value="NEXT >" name="next" class="button-large-right"></li>
                    </div>
                    <li class="warningtext" id="feedback"><?php echo $emailwarning ?></li>
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
<script>
    function checkEmailAvailability() {
    var email = $('#email').val();
    console.log(email);
    $.ajax({
        url: 'emailcheck.action.php',
        type: 'POST',
        data: { email: email },
        dataType: 'json',
        success: function(response) {
            if (response.available) {
                $('#feedback').text('This Email is available!').css('color', 'green');
            } else {
                $('#feedback').text('This account already exists').css('color', 'red');
            }
        }
    });
}
</script>
</html>

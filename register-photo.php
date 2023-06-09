<?php
    // ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    require_once(__DIR__ . '/vendor/autoload.php');
    $emailwarning = " ";
    $user = new User();
    $allCities = [];
    $allCities = City::getCity();
    if(isset($_SESSION['basisinfo'])){
        if(isset($_POST['finish'])){
            $firstname = $_SESSION['firstname-login'];
            $lastname = $_SESSION['lastname-login'];
            $email = $_SESSION['email-login'];
            $place = $_SESSION['place-login'];
            $adress = $_SESSION['adress-login'];
            $dob = $_SESSION['dob-login'];
            $citygroupid = $_SESSION['citygroupid'];
            $options = [
                'cost' => 10,
            ];
            $password = password_hash($_SESSION['password-login'], PASSWORD_DEFAULT, $options);
            $user->setEmail($email);
            if($user->getUser() === false){
                $user->setFirstname($firstname);
                $user->setLastname($lastname);
                $user->setCityId($place);
                $user->setCityGroupId($citygroupid);
                $user->setAdress($adress);
                $user->setPassword($password);
                $user->setDob($dob);
                        
                //fixing image
                $image = new Image();
                $image->setup();
                $image->upload("public", "profiles", "avatar");
                $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $randomstring = $image->getString();
                $destination = "public/profiles/".$randomstring.".".$ext;
                $user->setProfileImage($destination);
                $user->setUser();
                session_destroy();
                header("Location: ./login.php");
            }
            else{
                $emailwarning = "This email is already in use";
                var_dump($emailwarning);
            }
        }
        elseif(isset($_POST['back'])){
            session_destroy();
            header("Location: ./register.php");
        }
    }
    else{
        header("Location: ./register.php");
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
    <script src="JavaScript/carrousel.js" defer></script>
    <script src="JavaScript/registerimage.js" defer></script>
    <title>Copoll - Add a profile picture</title>
</head>
<body>
    <?php include_once(__DIR__ . "/navs/nav.php"); ?>
    <!-- photo form -->
    <div class="signupform">
        <div class="signupform-container-input">
            <form action="" method="post" enctype="multipart/form-data">
                <h1 style="margin: 0;">Profile picture</h1>
                <h5 style="margin-bottom: 48px;">UPLOAD A PROFILE PICTURE</h5>
                <ul class="mainform-register">
                    <div class="form-grid-container-left" style="height: 350px">
                        <li>
                            <label for="avatar" class="label-register" style="margin-left: 124px;" id="file-input"><input type="file" accept="image/*" id="avatar" name="avatar" class="input-register"></label>
                            <img alt="selected image" id="selected-image" style="display: none;">
                        </li>
                    </div>
                    <div class="form-grid-container-register-left" style="margin-top: 50px">
                        <li class="form-grid-item-register-1-2"><input type="submit" value="< BACK" name="back" class="button-large-left"></li>
                        <li class="form-grid-item-register-1-2"><input type="submit" value="FINISH >" name="finish" class="button-large-right"></li>
                    </div>
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

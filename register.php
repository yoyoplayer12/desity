<?php
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    $emailwarning = " ";
    $basisinfo = 0;
    $otherinfo = 0;
    $pfpicupload = 0;
    if(isset($_POST['register'])){
        $user = new User();
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $place = $_POST['place'];
		$options = [
			'cost' => 15,
		];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
        $user->setEmail($email);
        if($user->getUser() === false){
            //fixing image    
            $orig_file = $_FILES["avatar"]["tmp_name"];
            $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
            $target_dir = "assets/uploads/profiles/";
            $destination = "$target_dir$email.$ext";
            move_uploaded_file($orig_file, $destination);
            $user->setProfileImage($destination);
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setPlace($place);
            $user->setPassword($password);
            $user->setUser();
            $basisinfo = 1;
            // header("Location: login.php");
        }
        else{
            $emailwarning = "This email is already in use";
        }
    }
    elseif(isset($_POST['otherinfo'])){
        
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
    <title>Copoll - Create an account</title>
</head>
<body>
    <?php include_once(__DIR__ . "/nav.php"); ?>
    <!-- register form -->
    <div class="signupform">
        <div class="signupform-container-input">
            <?php if($basisinfo == 0):?>
                <form action="" method="post" enctype="multipart/form-data">
                    <h5>GET STARTED</h5>    
                    <h1 style="margin: 0;">Create an account</h1>
                    <p class="loginbuttontext-register">Already have an account? <a class="loginbutton-register" href="login.php">Log in</a></p>
                    <ul class="mainform-register">
                        <div class="form-grid-container-register-left">
                            <li class="form-grid-item-register-1-2"><input type="text" name="firstname" placeholder="First name" required></li>
                            <li class="form-grid-item-register-1-2"><input type="text" name="lastname" placeholder="Last name" required></li>
                        </div>
                        <li><input class="form-grid-item-register-2-2" type="email" name="email" placeholder="Email" required></li>
                        <div class="form-grid-container-register-left">
                            <select name="city" id="city" class="city-register" placehol required>
                                <option value="" disabled selected>City</option>
                                <option value="schiplaken">Schiplaken</option>
                                <option value="mechelen">Mechelen</option>
                            </select>
                            <li class="form-grid-item-register-1-2"><input type="text" name="street/number" placeholder="Street, number" required></li>
                        </div>
                        
                        <li><input class="form-grid-item-register-2-2" type="password" name="password" placeholder="Password" required></li>
                        <li><input class="form-grid-item-register-2-2" type="password" name="password-repeat" placeholder="Repeat password" required></li>
                        <li><input type="submit" value="NEXT" name="next"></li>
                        <li class="warningtext"><?php echo $emailwarning ?></li>
                    </ul>
                </form>
            <?php elseif($basisinfo == 1 && $otherinfo == 0): ?>
                <p>Other info</p>
                <!-- <form action="" method="post" enctype="multipart/form-data">
                    <ul>
                        <li>

                        </li>
                    </ul>
                </form> -->
            <?php elseif($basisinfo == 1 && $otherinfo == 1 && $pfpicupload == 0): ?>
            <!-- <div class="custom-file">
                <li><label class="custom-file-label" for="avatar">Choose a profile picture</label></li>
                <li><input type="file" accept="image/*" id="avatar" name="avatar" class="custom-file-input" required></li>
            </div> -->
            <?php endif; ?>
        </div>
        <div class="signupform-container-img">
            <img src="https://placehold.co/600x600" alt="Placeholder">
        </div>
    </div>

</body>
</html>

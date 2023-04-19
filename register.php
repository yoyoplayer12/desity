<?php
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    $emailwarning = " ";
    if(!empty($_POST)){
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
            header("Location: login.php");
        }
        else{
            $emailwarning = "This email is already in use";
        }
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
    <title>Copoll - Log in</title>
</head>
<body>
    <?php include_once(__DIR__ . "/nav.php"); ?>
    <!-- register form -->
    <div class="signupform">
        <form action="" method="post" enctype="multipart/form-data">
        <h5>GET STARTED</h5>    
        <h1 style="margin: 0;">Create an account</h1>
        <p class="loginbuttontext-register">Already have an account? <a class="loginbutton-register" href="login.php">Log in</a></p>
            <ul class="mainform-register">
                <div class="custom-file">
                    <li><label class="custom-file-label" for="avatar">Choose a profile picture</label></li>
                    <li><input type="file" accept="image/*" id="avatar" name="avatar" class="custom-file-input" required></li>
                </div>
                <li><input type="text" name="firstname" placeholder="First name" required></li>
                <li><input type="text" name="lastname" placeholder="Last name" required></li>
                <li><input type="email" name="email" placeholder="Email" required></li>
                <li><input type="text" name="place" placeholder="Place" required></li>
                <li><input type="password" name="password" placeholder="Password" required></li>
                <li><input type="password" name="password-repeat" placeholder="Repeat password" required></li>
                <li><input type="submit" value="Register"></li>
                <li class="warningtext"><?php echo $emailwarning ?></li>
            </ul>
        </form>
    </div>

</body>
</html>

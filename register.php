<?php
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    $emailwarning = " ";
    $basisinfo = 0;
    $pfpicupload = 0;
    $user = new User();
    $allCities = [];
    $allCities = City::getCity();
    if(isset($_POST['next']) && $basisinfo == 0){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $place = $_POST['city'];
        $adress = $_POST['adress'];
		$options = [
			'cost' => 15,
		];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
        $user->setEmail($email);
        if($user->getUser() === false){
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setCityId($place);
            $user->setAdress($adress);
            $user->setPassword($password);
            $user->setDob($_POST['date']);
            $basisinfo = 1;
        }
        else{
            $emailwarning = "This email is already in use";
        }
    }
    elseif(isset($_POST['finish']) && $basisinfo == 1 && $pfpicupload == 0){
        
        // fixing image
        // $orig_file = $_FILES["avatar"]["tmp_name"];
        // $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
        // $target_dir = "assets/uploads/posts/";
        // $destination = "$target_dir$randomstring$userId.$ext";
        // move_uploaded_file($orig_file, $destination);
        // $user->setProfileImage($destination);
        // $pfpicupload = 1;
        // $basisinfo = 1;
        // $user->setUser();
        header("Location: ./login.php");
    }
    elseif(isset($_POST['backtobasic']) && $basisinfo == 1){
        $basisinfo = 0;
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
                        <li><input type="submit" value="NEXT >" name="next" class="button-large"></li>
                        <li class="warningtext"><?php echo $emailwarning ?></li>
                    </ul>
                </form>
            <?php elseif($basisinfo == 1 && $pfpicupload == 0): ?>
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
                            <li class="form-grid-item-register-1-2"><input type="submit" value="< BACK" name="backtobasic" class="button-large"></li>
                            <li class="form-grid-item-register-1-2"><input type="submit" value="FINISH >" name="finish" class="button-large"></li>
                        </div>
                    </ul>
                </form>
            </div>
            <?php endif; ?>
        </div>
        <div class="signupform-container-img">
            <div class="gradientcitypic"></div>
            <div class="w3-content w3-section" style="max-width:500px">
                <?php foreach($allCities as $city): ?>
                    <img class="mySlides" src="<?php echo $city['city-pic'] ?>">
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}    
        x[myIndex-1].style.display = "block";  
        setTimeout(carousel, 10000); // Change image every 2 seconds
        }

        
        // Get the file input element
        const fileInput = document.getElementById('file-input');
        // Get the image element
        const img = document.getElementById('selected-image');
        // Add an event listener to the file input element
        fileInput.addEventListener('change', (event) => {
        // Get the selected file
        const selectedFile = event.target.files[0];
        if (selectedFile) {
            // A file has been selected
            console.log('File selected:', selectedFile.name);
            // Create a URL representing the selected file
            const imageURL = URL.createObjectURL(selectedFile);
            // Set the image source to the URL
            img.src = imageURL;
            // Show the image and hide the file input
            img.style.display = 'block';
            fileInput.style.display = 'none';
        } else {
            // No file has been selected
            console.log('No file selected');
            
            // Clear the image source and hide the image
            img.src = '';
            img.style.display = 'none';
            
            // Show the file input
            fileInput.style.display = 'block';
        }
        });
</script>
</body>
</html>

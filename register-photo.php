<?php
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
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
            $options = [
                'cost' => 15,
            ];
            $password = password_hash($_SESSION['password-login'], PASSWORD_DEFAULT, $options);
            $user->setEmail($email);
            if($user->getUser() === false){
                $user->setFirstname($firstname);
                $user->setLastname($lastname);
                $user->setCityId($place);
                $user->setAdress($adress);
                $user->setPassword($password);
                $user->setDob($dob);
                        
                //fixing image
                $randomstring = $user->getRandomStringRamdomInt();
                $orig_file = $_FILES["avatar"]["tmp_name"];
                $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
                $target_dir = "assets/uploads/profiles/";
                $destination = "$target_dir$randomstring$email.$ext";
                move_uploaded_file($orig_file, $destination);
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
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Copoll - Add a profile picture</title>
</head>
<body>
    <?php include_once(__DIR__ . "/nav.php"); ?>
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
                        <li class="form-grid-item-register-1-2"><input type="submit" value="< BACK" name="back" class="button-large"></li>
                        <li class="form-grid-item-register-1-2"><input type="submit" value="FINISH >" name="finish" class="button-large"></li>
                    </div>
                </ul>
            </form>
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
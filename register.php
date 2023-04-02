<?php
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
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
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setEmail($email);
        $user->setPlace($place);
        $user->setPassword($password);
        $user->setUser();
        header("Location: login.php");
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

    <div class="signupform">
        <form action="" method="post">
            <h1>Register</h1>
            <ul>
                <li><input type="file" name="pf-pic"></li>
                <li><input type="text" name="firstname" placeholder="First name" required></li>
                <li><input type="text" name="lastname" placeholder="Last name" required></li>
                <li><input type="text" name="email" placeholder="Email" required></li>
                <li><input type="text" name="place" placeholder="Place" required></li>
                <li><input type="password" name="password" placeholder="Password" required></li>
                <li><input type="password" name="password-repeat" placeholder="Repeat password" required></li>
                <li><input type="submit" value="Register"></li>
                <li><a href="login.php">Log in</a></li>
            </ul>
        </form>
    </div>

</body>
</html>

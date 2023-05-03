<?php 
    function canLogin($p_email, $p_password){
        $conn = Db::getInstance();
        //first, look for the user in the database
        $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $statement->bindValue(":email", $p_email); //sql injection protection
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if($user){
            $hash = $user['password']; //aha, contains salt and cost factor + final hash
            if(password_verify($p_password, $hash)){
                $_SESSION['userid'] = $user['id'];
                $_SESSION['firstname'] = $user['firstname'];
                $_SESSION['lastname'] = $user['lastname'];
                $_SESSION['placeid'] = $user['city_id'];
                $cityinfo = user::findCity($user['city_id']);
                $_SESSION['place'] = $cityinfo['city'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['pfpic'] = $user['photo_url'];
                $_SESSION['admin'] = $user['admin'];

                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
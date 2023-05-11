<?php
    include_once(__DIR__ . "/bootstrap.php");
    include_once(__DIR__ . "/loginCheck.php");
    if (isset($_SESSION["loggedin"])) {
        if ($_SESSION["opperadmin"] == 1){
            
        }
        else{
            header("Location: ./dashboard.php");
        }
    }
    else{
        header("Location: ./login.php");
    }
    if(!empty($_POST)){
        if(isset($_POST['submit-citygroup'])){
            $newgroup = new Citygroup();
            $citygroup = $_POST['citygroup'];
            $citygroup = strip_tags($citygroup);
            $citygroup = htmlspecialchars($citygroup);
            $citygroup = strtolower($citygroup);
            $citygroup = preg_replace('/\s+/', '-', $citygroup);
            $citygroup = preg_replace('/[^A-Za-z0-9\-]/', '-', $citygroup);
            $newgroup->setName($citygroup);
            $newgroup->save();
            
        }
        elseif(isset($_POST['submit-city'])){
            $newcity = new City();
            $city = $_POST['city'];
            $city = strip_tags($city);
            $city = htmlspecialchars($city);
            $city = strtolower($city);
            $city = preg_replace('/\s+/', '-', $city);
            $city = preg_replace('/[^A-Za-z0-9\-]/', '-', $city);
            $newcity->setName($city);


            
// This needs fixing

            // set city pic here
            $randomstring = $newcity->getRandomStringRamdomInt();
            $orig_file = $_FILES["citypic"]["tmp_name"];
            $ext = pathinfo($_FILES["citypic"]["name"], PATHINFO_EXTENSION);
            $target_dir = "assets/uploads/cities/";
            $destination = "$target_dir$randomstring$city.$ext";
            // move_uploaded_file($orig_file, $destination);
            $newcity->setCityPic($destination);
            var_dump($destination);
            $newcity->setCityGroupId($_POST['groupid']);
            die();
            $newcity->save();


// This needs fixing




        }
    }

    $allCitygroups = [];
    $allCitygroups = Citygroup::getAllCitygroups();
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
    <title>Copoll - Opper Admin</title>
</head>
<body>
    <?php include_once(__DIR__ . "/navs/dashnav.php"); ?>
    <h1 style="text-align: center; margin-top:0;padding-top:40px;">Opperadmin panel</h1>

    <form action="" method="post" style="margin-left: 300px;margin-bottom: 100px;width:200px">
        <input type="text" name="citygroup" placeholder="New citygroup" style="border:1px solid black;border-radius:4px;">
        <input type="submit" name="submit-citygroup" value="New citygroup" style="cursor:pointer;">
    </form>
    <h2 style="margin-left: 300px;margin-bottom:50px;">CITY GROUPS:</h2>
    <!-- The citygroups -->
    <?php foreach($allCitygroups as $citygroup): ?> 
        <div style="margin-left: 300px;margin-bottom: 50px;width: 80vw;padding:20px;border:1px solid black;border-radius:4px;">
        <?php $allcities = Citygroup::getCityByGroup($citygroup['id']); ?>
            <h2><?php echo $citygroup['name'] ?></h2>


            <!-- The cities -->

            <div style="margin-left: 100px;">
                <h3>City:</h3>
                <?php if(empty($allcities)): ?>
                    <p>No cities found</p>
                <?php else: ?>
                    <ol>
                        <?php foreach($allcities as $city): ?>
                            <li><?php echo $city['city']." (".date('d M Y', strtotime($city['startdate'])).")" ?></li>
                        <?php endforeach; ?>
                    </ol>
                <?php endif; ?>
                <form action="" method="post" style="width:200px;margin-top:50px;">
                    <input type="text" name="city" placeholder="New city" style="border:1px solid black;border-radius:4px;">
                    <input type="file" accept="image/*" name="citypic" style="border:none;cursor:pointer;">
                    <!-- not safe, but works for us -->
                    <input type="hidden" name="groupid" value="<?php echo $citygroup['id'] ?>">
                    <!-- not safe, but works for us -->
                    <input type="submit" name="submit-city" value="Add a new city to <?php echo $citygroup['name']?>" style="cursor:pointer;">
                </form>
            </div>

            <!-- End of the cities -->


        </div>
    <?php endforeach; ?>
    <!-- End of the citygroups -->
        
</body>
</html>

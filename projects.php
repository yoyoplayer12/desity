<?php
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    if(isset($_SESSION["loggedin"])) {
    }
    else{
        header("Location: ./login.php");
    }
    if (isset($_GET['id'])){
        //beveiligen
        $id = $_GET['id'];
        //beveiligen
    }
    else{
        $alluserprojects = Thinker::getAllUserProjects($_SESSION['userid']);
        $allContributingProjects = Project::getIdActiveProject($alluserprojects[0]['project_id']);
        $id = $allContributingProjects['id'];
    }
    $project = Project::getProjectById($id);
    $allAnnouncements = Announcement::getAllProjectAnnouncements($id);
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
    <title>Dashboard - Projects</title>
</head>
<body>
    <?php include_once(__DIR__ . "/navs/dashnav.php"); ?>
    <div class="projectcontent">
        <div class="projecttop">
            <h5 style="text-transform: uppercase"><?php echo $project['title']?></h5>
            <?php include_once(__DIR__ . "/navs/projectnav.php"); ?>
            <h4 style="margin-top: 32px;"><?php echo $project['summarytitle']?></h4>
            <p class="body-normal projectsummary"><?php echo $project['summary']?></p>
        </div>
       

        <div class="bottom-section">
            <div class="upcoming-schedules-projects">
                <div class="ongoing-polls">
                    <h5 style="margin-top: 0;">UPCOMING SCHEDULES</h4>
                   
                </div>
            </div>
           
            <div class="recentannouncements-projects">
                <div class="recent-announcements">
                    <h5 style="margin-top: 0;">PROJECT ANNOUNCEMENTS</h5>
                    <?php foreach($allAnnouncements as $announcement): ?>
                        <?php $city = City::getCityById($announcement['city_id']); ?>
                        <div class="announcementcard">
                            <div class="announcementcardimg" style="background-image:url(<?php echo $url.$city['city-pic'] ?>);"></div>
                            <p class="body-medium-xl"><?php echo $city['city'] ?></p>
                            <p class="body-small" id="announcementcardtext"><?php echo $announcement['content'] ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
        </div>
        
    </div>
</body>
</html>
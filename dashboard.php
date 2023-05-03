<?php
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    if(isset($_SESSION["loggedin"])) {
    }
    else{
        header("Location: ./login.php");
    }
    $allPolls = [];
    $allProjects = [];
    $allAnnouncements = [];
    $allPolls = Poll::getActiveMainPolls();
    $allProjects = Project::getAllSearchingGroupProjects($_SESSION['citygroupid']);
    $allAnnouncements = Announcement::getAllCitygroupAnnouncements($_SESSION['citygroupid']);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Copoll - Home</title>
</head>
<body>
    <?php include_once(__DIR__ . "/dashnav.php"); ?>
    <div class="dashcontent">
        <div class="projects">
            <h4>Open projects</h4>
            <?php foreach($allProjects as $project): ?>
                <?php $city = City::getCityById($project['city_id']); ?>
                <div class="projectcard">
                    <div class="projectcardimg" style="background-image: url(<?php echo $project['img-url']?>);"></div>
                    <div class="projectcardinfo">
                        <h5 style="margin-bottom: 8px; margin-top:0" class="projectcard-title"><?php echo $project['title']?></h5>
                        <p class="body-xs"><?php echo $city['city']?></p>
                        <p class="body-normal" id="projectcardsummary"><?php echo $project['summary']?></p>
                        <div class="readmore-div-projectcard"><a href="#" class="read-more-projectcard">READ MORE</a></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="rightdiv">
            <div class="ongoing-polls">
                <h4>Ongoing polls</h4>
                <?php foreach($allPolls as $Poll): ?>
                    <?php $project = Project::getProjectById($Poll['project_id']); ?>
                    <div class="pollcard">
                        <div class="pollcardimg" style="background-image:url(<?php echo $project['img-url'] ?>);"></div>
                        <p class="body-medium-xl" id="pollcardtitle"><?php echo $project['title'] ?></p>
                        <p class="body-xs" id="polldates"><?php echo $Poll['startdate']. " ° ". $Poll['enddate'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="recent-announcements">
                <h4>Recent announcements</h4>
                <?php foreach($allAnnouncements as $announcement): ?>
                    <?php $city = City::getCityById($announcement['city_id']); ?>
                    <div class="announcementcard">
                        <div class="announcementcardimg" style="background-image:url(<?php echo $city['city-pic'] ?>);"></div>
                        <p class="body-medium-xl"><?php echo $city['city'] ?></p>
                        <p class="body-small" id="announcementcardtext"><?php echo $announcement['content'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
    </div>

</body>
</html>
<?php
    $alluserprojects = Thinker::getAllUserProjects($_SESSION['userid']);
    if($alluserprojects == []){
        $display = "display: none;";
    }
    else{
        $display = "";
    }
    $image = new Image();
    $url = $image->getUrl();
?>
<nav class="dashnav">
    <ul class="dashnavgrid-top">
        <li class="twocolumns"><a href="index.php"><img class="navlogo" src="<?php echo $url."assets/brand/mc58pu4mvo7bxotb5mcx.svg" ?>" alt="Copoll logo" style="height: 40px; margin: 16px"></a></li>
        <div class="toppart">
            <div class="dashboardico"></div>
            <a href="dashboard.php" class="btn menuitems">Dashboard</a>
            <div class="projectico"></div>
            <a href="projects.php" class="btn menuitems">Projects</a>
            <div class="subprojects" style="<?php echo $display?>">
                <?php foreach($alluserprojects as $AllProjects):?>
                    <?php $allContributingProjects = Project::getIdActiveProject($AllProjects['project_id']); ?>
                    <ul>
                        <li class="subprojectnav"><div class="projectbox"></div><a href="projects.php?id=<?php echo $allContributingProjects['id']?>" class="subproject"><?php echo $allContributingProjects['title']?></a></li>
                    </ul>
                <?php endforeach; ?>
            </div>
            <div class="scheduleico"></div>
            <a href="Schedule.php" class="btn menuitems">Schedule</a>
            <div class="chatico"></div>
            <a href="chat.php" class="btn menuitems">Chat</a>
            <div class="peopleico"></div>
            <a href="people.php" class="btn menuitems">People</a>
        </div>
    </ul>
    <div class="bottompart">
        <div class="notico"></div>
        <a href="" class="btn">Notifications</a>
        <div class="accico"></div>
        <a href="account.php" class="btn"><?php echo $_SESSION['firstname']. " " .$_SESSION['lastname'] ?></a>
        <div class="setico"></div>
        <a href="settings.php" class="btn">Settings</a>
    </div>
</nav>
<?php
    $alluserprojects = Thinker::getAllUserProjects($_SESSION['userid']);
?>
<nav class="dashnav">
    <ul>
        <li><a href="index.php"><img class="navlogo" src="assets/brand/logo-horizontal-white.svg" alt="Copoll logo" style="height: 40px; margin: 16px"></a></li>
        <div class="toppart">
            <li><a href="dashboard.php" class="btn">Dashboard</a></li>
            <li>
                <a href="projects.php" class="btn">Projects</a>
                <?php foreach($alluserprojects as $AllProjects):?>
                    <?php $allContributingProjects = Project::getIdActiveProjects($AllProjects['project_id']); ?>
                <ul>
                    <li class="subprojectnav"><div class="projectbox"></div><a href="projects.php?id=<?php echo $allContributingProjects['id']?>" class="subproject"><?php echo $allContributingProjects['title']?></a></li>
                </ul>
                <?php endforeach; ?>
        
            </li>
            <li><a href="Schedule.php" class="btn">Schedule</a></li>
            <li><a href="chat.php" class="btn">Chat</a></li>
            <li><a href="people.php" class="btn">People</a></li>
        </div>
        <div class="bottompart">
            <li><a href="" class="btn">Notifications</a></li>
            <li><a href="account.php" class="btn"><?php echo $_SESSION['firstname']. " " .$_SESSION['lastname'] ?></a></li>
            <li><a href="settings.php" class="btn">Settings</a></li>
        </div>
    </ul>
</nav>
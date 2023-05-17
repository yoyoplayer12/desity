<?php
    $image = new Image();
    $url = $image->getUrl();
?>
<nav class="sitenav">
    <a href="index.php"><img class="navlogo" src="<?php echo $url."assets/brand/y1uiedctgpxpgbl85xcv.svg" ?>" alt="Copoll logo" style="height: 48px;"></a>
    <ul>
        <li><a href="dashboard.php">SERVICES</a></li>
        <li><a href="about.php">ABOUT</a></li>
        <li><a href="contact.php">CONTACT</a></li>
        <li><a href="login.php" class="dashboardbutton-index">DASHBOARD</a></li>
    </ul>
</nav>
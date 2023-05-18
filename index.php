<?php
    include_once(__DIR__ . "/bootstrap.php");
    $image = new Image();
    $url = $image->getUrl();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="<?php echo $url."assets/brand/ppyo2h0le7ysvsembls6" ?>" style="height:40px" type="image/svg">
    <title>Copoll</title>
</head>
<body>
    <?php include_once(__DIR__ . "/navs/nav.php"); ?>
    <div class="grid-container-index">
        <div class="grid-item-index">
            <h1 class="slogan">Your voice matters, let it be heard</h1>
            <p style="width: 640px;" class="body-large">copoll is a collaborative platform that empowers municipalities to involve their citizens in decision-making, streamline communication, and drive meaningful change in their communities.</p>
            <div class="index-actionbuttons">
                <a href="register.php" class="getstarted">GET STARTED</a>
                <a href="#" class="contactus">CONTACT US</a>
            </div>
        </div>
        <div class="pc-container">
            <div class="computer-wrapper">
                <!-- First computer mockup -->
                <img src="<?php echo $url."assets/brand/fxthcxkwazpwrrzhjy1e.png" ?>" alt="Home" class="computer computer-1">
                <!-- Second computer mockup -->
                <img src="<?php echo $url."assets/brand/azmpdaxsx2gehgzygtrv.png" ?>" alt="Summary" class="computer computer-2">
            </div>
        </div> 
        <div class="pricing-container">
            <div class="pricing-container-item info" id="about">
                <div class="info-container">
                    <img src="<?php echo $url."assets/icons/on4amjs9bhnng1lsowdb.png" ?>" alt="placeholder">
                    <h3>Join Projects</h3>
                    <p class="body-normal">Discover a diverse range of projects in your community and join forces with like-minded individuals to contribute your skills, knowledge, and passion. Together, you can create meaningful impact and shape the future of your municipality.</p>
                </div>
            </div>
            <div class="pricing-container-item info">
                <div class="info-container">
                    <img src="<?php echo $url."assets/icons/gdeac942hvs2ppp0zokg.png" ?>" alt="placeholder">
                    <h3>Collaborate</h3>
                    <p class="body-normal">Collaborate with fellow citizens and the municipality, bridging the gap between community and government. Share ideas, exchange perspectives, and work together towards common goals, fostering a culture of collaboration and co-creation.</p>
                </div>
            </div>
            <div class="pricing-container-item info">
                <div class="info-container">
                    <img src="<?php echo $url."assets/icons/w48kxypoldxniyuhwk6n.png" ?>" alt="placeholder">
                    <h3>Make a Difference</h3>
                    <p class="body-normal">Be the catalyst for change in your town. Your voice matters, and by actively participating in projects and initiatives, you have the power to make a difference. Join us in creating positive transformations and building a thriving community for all.</p>
                </div>
            </div>
            <div class="pricing-container-title"><h2 id="pricing">Pricing plans</h2></div>
            <div class="pricing-container-item price">
                <div class="pricing-plans-container">
                    <h5>RESIDENTS</h5>
                    <h3>Free</h3>
                    <p class="body-normal">Lorem ipsum dolor sit amet consectetur. Adipiscing id praesent.</p>
                    <ul class="body-normal">
                        <li>Browse and join projects</li>
                        <li>Collaborate with other residents</li>
                        <li>Vote and participate in polls</li>
                        <li>Contribute to discussions</li>
                        <li>Stay informed about project updates</li>
                        <li>Engage with the municipality and citizens</li>
                    </ul>
                    <div style="height: 149px"></div>
                    <a href="#">GET STARTED</a>
                </div>
            </div>
            <div class="pricing-container-item price">
                <div class="pricing-plans-container">
                    <h5>STANDARD MUNICIPALITY</h5>
                    <h3>Variable</h3>
                    <p class="body-normal">Lorem ipsum dolor sit amet consectetur. Adipiscing id praesent.</p>
                    <ul class="body-normal">
                        <li>Create and manage projects</li>
                        <li>Launch and manage polls</li>
                        <li>Access analytics and reporting</li>
                        <li>Engage with your residents</li>
                        <li>Invite members to your team</li>
                        <li>Assign roles to your team members</li>
                    </ul>
                    <div style="height: 149px"></div>
                    <a href="#" class="filled-pricebutton">CONTACT US</a>
                </div>
            </div>
            <div class="pricing-container-item price">
                <div class="pricing-plans-container">
                    <h5>PREMIUM MUNICIPALITY</h5>
                    <h3>Variable</h3>
                    <p class="body-normal">Lorem ipsum dolor sit amet consectetur. Adipiscing id praesent.</p>
                    <ul class="body-normal">
                        <li>Everything from the standard plan</li>
                        <li>Priority customer support</li>
                        <li>Increased project capacity</li>
                        <li>Extended File Storage</li>
                        <li>Training and Onboarding</li>
                    </ul>
                    <div style="height: 201px"></div>
                    <a href="#" class="filled-pricebutton">CONTACT US</a>
                </div>
            </div>
        </div>
    </div>
    <?php include_once(__DIR__ . "/navs/footer.php"); ?>
</body>
</html>
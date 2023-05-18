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
            <h1 class="slogan">Your voice matters, <br> be heard</h1>
            <p style="width: 640px;" class="body-large">copoll is a collaborative platform that empowers municipalities to involve their citizens in decision-making, streamline communication, and drive meaningful change in their communities.</p>
            <div class="index-actionbuttons">
                <a href="register.php" class="getstarted">GET STARTED</a>
                <a href="contact.php" class="contactus">CONTACT US</a>
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
                    <ul class="body-normal pricingplans">
                        <div></div>
                        <li>Browse and join projects</li>
                        <div></div>
                        <li>Collaborate with other residents</li>
                        <div></div>
                        <li>Vote and participate in polls</li>
                        <div></div>
                        <li>Contribute to discussions</li>
                        <div></div>
                        <li>Stay informed about project updates</li>
                        <div></div>
                        <li>Engage with the municipality and citizens</li>
                    </ul>
                    <div style="height: 149px"></div>
                    <a href="register.php">GET STARTED</a>
                </div>
            </div>
            <div class="pricing-container-item price">
                <div class="pricing-plans-container">
                    <h5>STANDARD MUNICIPALITY</h5>
                    <h3>Variable</h3>
                    <p class="body-normal">Lorem ipsum dolor sit amet consectetur. Adipiscing id praesent.</p>
                    <ul class="body-normal pricingplans">
                        <div></div>
                        <li>Create and manage projects</li>
                        <div></div>
                        <li>Launch and manage polls</li>
                        <div></div>
                        <li>Access analytics and reporting</li>
                        <div></div>
                        <li>Engage with your residents</li>
                        <div></div>
                        <li>Invite members to your team</li>
                        <div></div>
                        <li>Assign roles to your team members</li>
                    </ul>
                    <div style="height: 149px"></div>
                    <a href="mailto:info@copoll.live?subject=Joining%20Copoll%20as%20a%20standard%20municipality&body=Give%20us%20any%20usefull%20info%20about%20your%20city.%20(Name,%20mayor,%20population%20count,...)" class="filled-pricebutton">CONTACT US</a>
                </div>
            </div>
            <div class="pricing-container-item price">
                <div class="pricing-plans-container">
                    <h5>PREMIUM MUNICIPALITY</h5>
                    <h3>Variable</h3>
                    <p class="body-normal">Lorem ipsum dolor sit amet consectetur. Adipiscing id praesent.</p>
                    <ul class="body-normal pricingplans">
                        <div></div>
                        <li>Everything from the standard plan</li>
                        <div></div>
                        <li>Priority customer support</li>
                        <div></div>
                        <li>Increased project capacity</li>
                        <div></div>
                        <li>Extended File Storage</li>
                        <div></div>
                        <li>Training and Onboarding</li>
                    </ul>
                    <div style="height: 181px"></div>
                    <a href="mailto:info@copoll.live?subject=Joining%20Copoll%20as%20a%20premium%20municipality&body=Give%20us%20any%20usefull%20info%20about%20your%20city.%20(Name,%20mayor,%20population%20count,...)" class="filled-pricebutton">CONTACT US</a>
                </div>
            </div>
        </div>
    </div>
    <?php include_once(__DIR__ . "/navs/footer.php"); ?>
</body>
</html>
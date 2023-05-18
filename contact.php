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
    <title>Copoll - Contact</title>
</head>
<body>
    <?php include_once(__DIR__ . "/navs/nav.php"); ?>
    <div class="grid-container-contact">
        <div class="contact-head-container">
            <h1>Contact us</h1>
            <p class="body-xl">For any inquiries or assistance, please don't hesitate to get in touch with us. <br> We're here to help and look forward to hearing from you.</p>
        </div>
        <div class="contact-options">
            <div class="contact-options-item">
                <div class="contact-reachout-img"></div>
                <h3>Reach out to us</h3>
                <p class="body-small">Have a question, suggestion, or general inquiry? We're here to help! Use this contact info to get in touch with us, and we'll respond as soon as possible.</p>
                <ul class="body-normal contactlist">
                    <div class="phonelist"></div>
                    <li>+32 468 26 11 20</li>
                    <div class="maillist"></div>
                    <li><a href="mailto:info@copoll.live?subject=I%20have%20a%20question%20about...">info@copoll.live</a></li>
                </ul>
            </div>
            <div class="contact-options-item">
                <div class="contact-joinus-img"></div>
                <h3>Join us</h3>
                <p class="body-small">Municipalities interested in collaborating with us and leveraging our platform for citizen engagement can use this contact info to submit a request.</p>
                <ul class="body-normal contactlist">
                    <div class="phonelist"></div>
                    <li>+32 475 71 61 86</li>
                    <div class="maillist"></div>
                    <li><a href="mailto:info@copoll.live?subject=Joining%20Copoll%20as%20a%20standard%20municipality&body=Give%20us%20any%20usefull%20info%20about%20your%20city.%20(Name,%20mayor,%20population%20count,...)">requests@copoll.live</a></li>
                </ul>
            </div>
            </div>
        </div>
    </div>
    <?php include_once(__DIR__ . "/navs/footer.php"); ?>
</body>
</html>
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
            <h1 class="slogan">Your voice matters, <br> let it be heard</h1>
            <p style="width: 400px">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam reprehenderit sed vitae exercitationem, corrupti, unde autem culpa perferendis dignissimos consequuntur, quod temporibus nostrum odio perspiciatis eum sequi aut nihil. Esse.</p>
        </div>
        <div>
            <img src="https://placehold.co/640" alt="Placeholder">
        </div>
    </div>
</body>
</html>
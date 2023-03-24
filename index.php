<?php 
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    $allPosts = [];
    $allPosts = Post::getPost();;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Desity - Home</title>
</head>
<body>
    <?php foreach($allPosts as $post): ?>
        <div>
            <ul>
                <li><?php echo $post['title']?></li>
                <li><?php echo $post['content']?></li>
            </ul>
            <!-- <img src="" alt="">
            <address>Username</address>
            <p>content</p>
            <address>Date</address> -->
        </div>
    <?php endforeach; ?>
</body>
</html>

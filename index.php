<?php 
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    if($_SESSION['loggedin'] === true) {
        if (!empty($_POST)) {
            try{
    
                $post = new Post();
                $post->setTitle($_POST['title']);
                $post->setContent($_POST['content']);
                $post->setUserId($_SESSION["userid"]);
                // $user_id = $_SESSION['user_id'];
                $post->setPost();
              }
              catch(Throwable $e){
                echo $e->getMessage();
              }
           
        }
        $allPosts = [];
        $allPosts = Post::getPost();
        $fp_place = $_SESSION["place"];
        $fp_name = $_SESSION["firstname"] . $_SESSION["lastname"];;
      }
      else{
        header("Location: ./login.php");
      }
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
    <?php include_once(__DIR__ . "/nav.php"); ?>
    <div class="feed">
        <div class="newpost">
            <form action="" method="post">
                <ul>
                    <li><h1 class="newposttitle">New post</h1></li>
                    <li><input type="text" name="title" placeholder="Title" required></li>
                    <li><input type="text" name="content" placeholder="Content" required></li>
                    <li><input type="file" id="post-image" name="post-image" accept="image/png, image/jpeg, image/jpg" value="empty"></li>
                    <li><input type="submit" value="Post"></li>
                </ul>
                
                
               

            </form>
        </div>
        <h1 class="fp-place"><?php echo $fp_place ?></h1>
        <?php foreach($allPosts as $post): ?>
            <?php $allPostUsers = Post::getPostUser($post['user_id']); ?>
                <div class="feedpost">
                    <ul>
                        <li><h1><?php echo $post['title']?></h1></li>
                        <li><?php echo $allPostUsers[0]['firstname']. " " .$allPostUsers[0]['lastname']?></li>
                        <li><img src="<?php echo $post['photo_url']?>" alt="post photo"></li>
                        <li><?php echo $post['content']?></li>
                        <li><?php echo substr($post['postdate'],0,16)?></li>
                    </ul>
                    <!-- <img src="" alt="">
                    <address>Username</address>
                    <p>content</p>
                    <address>Date</address> -->
                </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

<?php 
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    if(isset($_SESSION["loggedin"])) {
        if (!empty($_POST)) {
            try{
                $post = new Post();
                $poll = new Poll();
                //fixing image
                $title = $_POST['title'];
                $userId = $_SESSION['userid'];
                $orig_file = $_FILES["post-image"]["tmp_name"];
                $ext = pathinfo($_FILES["post-image"]["name"], PATHINFO_EXTENSION);
                $target_dir = "assets/uploads/posts/";
                $destination = "$target_dir$title$userId.$ext";
                move_uploaded_file($orig_file, $destination);
                $post->setPostImage($destination);
                $post->setTitle($_POST['title']);
                $post->setContent($_POST['content']);
                $post->setUserId($_SESSION["userid"]);
                //pollstuff and final post setting
                $post->setPost();
              }
              catch(Throwable $e){
                echo $e->getMessage();
              }
        }
        $allPosts = [];
        $allComments = [];
        $allMainPolls = [];
        $allPollOptions = [];
        $allPosts = Post::getPost();
        $allComments = Comment::getComment();
        $allMainPolls = Poll::getMainPolls();
        $allPollOptions = Poll::getPollOption();
        $fp_place = $_SESSION["place"];
        $fp_name = $_SESSION["firstname"] . " " . $_SESSION["lastname"];;
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
    <!-- feed starts here -->
    <div class="feed">
        <!-- create a new post -->
        <?php if($_SESSION['admin'] == 1): ?>
        <div class="newpost">
            <form action="" method="post" enctype="multipart/form-data">
                <ul>
                    <li><h1 class="newposttitle">New post</h1></li>
                    <li><input type="text" name="title" placeholder="Title" required></li>
                    <li><input type="text" name="content" placeholder="Content" required></li>
                    <li><input type="text" name="Poll-title" placeholder="Poll Title" required></li>
                    <li><input type="text" name="Poll-option-1" placeholder="Poll option 1" required></li>
                    <li><input type="text" name="Poll-option-2" placeholder="Poll option 2" required></li>
                    <li><input type="text" name="Poll-option-3" placeholder="Poll option 3"></li>
                    <li><input type="file" id="post-image" name="post-image" accept="image/*" required></li>
                    <li><input type="submit" value="Post"></li>
                </ul>
            </form>
        </div>
        <?php elseif($_SESSION['admin'] == 0): ?>
        <?php endif; ?>
        <!-- show all posts -->
        <h1 class="fp-place"><?php echo $fp_place ?></h1>
        <?php 
        if (empty($allPosts)) {
            echo "<h1 class='noposts'>Sorry, your neighborhood hasn't posted yet!</h1>";
        }
        else{
            foreach($allPosts as $post): ?>
                <?php $allPostUsers = Post::getPostUser($post['user_id']); ?>
                <?php $_SESSION["postid"] = $post['id'] ?>
                    <div class="feedpost">
                        <div class="post">
                            <ul>
                                <li><h1><?php echo $post['title']?></h1></li>
                                <li><?php echo $allPostUsers[0]['firstname']. " " .$allPostUsers[0]['lastname']?></li>
                                <li><img class="postpic" src="<?php echo $post['photo_url']?>" alt="post photo"></li>
                                <li><?php echo $post['content']?></li>
                                <li><?php echo substr($post['postdate'],0,16)?></li>
                            </ul>
                        </div>
                        <!-- show all poll options -->
                        <div class="poll">
                            <?php foreach($allMainPolls as $mainpolls): ?>
                                <h1 class="mainpolltitle"><?php echo $mainpolls['title']?></h1>
                                <?php if($mainpolls['post_id'] == $post['id']):?>
                                    <?php foreach($allPollOptions as $pollOption): ?>
                                        <?php if($pollOption['mainpoll_id'] == $mainpolls['id']):?>
                                            <div class="poll-options">
                                                <ul>
                                                    <li class="polltitle"><?php echo $pollOption['title']?></li>
                                                    <li class="pollvotes"><a href="#" id="like"><?php echo $pollOption["votes"]?> vote</a></li>
                                                </ul>
                                            </div>
                                        <?php endif;?>
                                        <?php endforeach;?>
                                <?php endif;?>
                                <?php endforeach;?>
                        </div>
                        <!-- show all comments -->
                        <div class="comment">
                            <h1 class="commentheader">Comments</h1>
                            <?php foreach($allComments as $comment): ?>
                                <?php $allCommentUsers = Comment::getCommentUser($comment['user_id']); ?>
                                <?php if($comment['post_id'] == $post['id']):?>
                                    <div>
                                        <ul>
                                            <li class="commentname"><?php echo $allCommentUsers[0]['firstname']. " " .$allCommentUsers[0]['lastname']?></li>
                                            <li><?php echo $comment['content']?></li>
                                            <li><?php echo substr($comment['date'],0,16)?></li>
                                            <li><a href="like.action.php" id="like"><?php echo $comment["likes"]?> likebutton</a></li>
                                        </ul>
                                    </div>
                                <?php endif;?>
                                <?php endforeach;?>
                            <!-- create a new comment -->
                            <div class="newcomment"> 
                                <form action="newcomment.action.php" method="post">
                                    <ul>
                                        <li><input type="text" name="content" placeholder="Comment" required></li>
                                        <li><input type="submit" value="Send"></li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
            <?php endforeach; }?>
    </div>
</body>
</html>

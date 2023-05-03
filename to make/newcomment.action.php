<?php
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    if($_SESSION['loggedin'] === true) {
        if (!empty($_POST)) {
            try{
                $comment = new Comment();
                $comment->setContent($_POST['content']);
                $comment->setUserId($_SESSION["userid"]);
                $comment->setPostId($_SESSION["postid"]);
                $comment->setComment();
                header("Location: ./dashboard.php");
              }
              catch(Throwable $e){
                echo $e->getMessage();
              }
        }
    }
    else{
        echo "shit";
    }
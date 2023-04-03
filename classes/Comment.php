<?php class Comment{
    private $content;
    private $user_id;
    private $post_id;
    public static function getComment(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM comments WHERE active=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    public static function getCommentUser($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT id, firstname, lastname, photo_url FROM users WHERE active=1 AND id = $id");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function setContent($content){
        $this->content = $content;
        return $this;
    }
    public function setUserId($user_id){
        $this->user_id = $user_id;
        return $this;
    }
    public function setPostId($post_id){
        $this->post_id = $post_id;
        return $this;
    }
    public function setComment(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO comments(`content`, `user_id`, `post_id`) VALUES (:content,:user_id,:post_id)");
        $statement->bindValue(":content", $this->content);
        $statement->bindValue(":user_id", $this->user_id);
        $statement->bindValue(":post_id", $this->post_id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result);
        return $result;
    }
    public static function setLike($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE comments SET likes = likes + 1 WHERE id = $id");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
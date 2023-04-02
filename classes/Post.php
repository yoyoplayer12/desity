<?php class Post{
    private string $title;
    private string $content;
    private string $photo_url;
    private string $user_id;
    public static function getPost(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM posts WHERE active=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getPostUser($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT id, firstname, lastname, photo_url FROM users WHERE active=1 AND id = $id");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }
    public function setContent($content){
        $this->content = $content;
        return $this;
    }
    public function setPhotoUrl($photo_url){
        $this->photo_url = $photo_url;
        var_dump($this->photo_url);
        return $this;
    }
    public function setUserId($user_id){
        $this->user_id = $user_id;
        return $this;
    }
    public function setPost(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO posts(`title`, `photo_url`, `content`, `user_id`) VALUES (:title,'https://picsum.photos/600/400',:content,:user_id)");
        $statement->bindValue(":title", $this->title);
        $statement->bindValue(":content", $this->content);
        // $statement->bindValue(":photo_url", $this->photo_url);
        $statement->bindValue(":user_id", $this->user_id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

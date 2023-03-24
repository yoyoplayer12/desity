<?php class Post{
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
}
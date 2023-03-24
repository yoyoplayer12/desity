<?php class Post{
       public static function getPost(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM posts");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
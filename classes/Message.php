<?php class Message{
    public static function getLastMessageByProject($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM messages WHERE project_id=:id AND active=1 AND deleted=0 ORDER BY senddate DESC LIMIT 1");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetch();
    }
}
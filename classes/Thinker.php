<?php class Thinker{
    public static function getAllThinkingProjects($projectid, $userid){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM thinkers WHERE project_id=:projectid AND user_id=:userid");
        $statement->bindValue(":projectid", $projectid);
        $statement->bindValue(":userid", $userid);
        $statement->execute();
        return $statement->fetchAll();
    }
    public static function getAllUserProjects($userid){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM thinkers WHERE user_id=:userid AND active=1");
        $statement->bindValue(":userid", $userid);
        $statement->execute();
        return $statement->fetchAll();
    }
    public static function getAllThinkersByProject($projectid){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM thinkers WHERE project_id=:projectid AND active=1");
        $statement->bindValue(":projectid", $projectid);
        $statement->execute();
        return $statement->fetchAll();
    }
}
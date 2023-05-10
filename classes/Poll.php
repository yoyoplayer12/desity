<?php class Poll{
    public static function getPollbyProjectId($projectid){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM mainpoll WHERE active=1 AND startdate <= NOW() AND enddate >= NOW() AND project_id=:projectid");
        $statement->bindValue(":projectid", $projectid);
        $statement->execute();
        return $statement->fetch();
    }
    public static function getPollOption(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM poll WHERE active=1");
        $statement->execute();
        return $statement->fetchAll();
    }
}
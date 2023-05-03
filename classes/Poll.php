<?php class Poll{
    public static function getActiveMainPolls(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM mainpoll WHERE active=1 AND startdate <= NOW() AND enddate >= NOW()");
        $statement->execute();
        return $statement->fetchAll();
    }
    public static function getPollOption(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM poll WHERE active=1");
        $statement->execute();
        return $statement->fetchAll();
    }
}
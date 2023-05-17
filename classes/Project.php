<?php class Project{
    public static function getAllSearchingGroupProjects($groupid){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM projects WHERE active=1 AND needsthinkers=1 AND deleted=0 AND citygroup_id=$groupid ORDER BY creationdate DESC");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getAllGroupActivePollingProjects($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM projects WHERE citygroup_id=$id AND active=1 AND deleted=0 and startdate <= NOW() AND enddate >= NOW() AND ispublicpolling=1 ORDER BY creationdate DESC");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getIdActiveProject($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM projects WHERE active=1 AND deleted=0 AND startdate <= NOW() AND enddate >= NOW() AND id=$id ORDER BY title DESC");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getProjectById($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM projects WHERE id=$id");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getFirstUserProjectId($userid){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM projects WHERE id IN (SELECT project_id from thinkers WHERE user_id=:userid AND active=1) AND active=1 AND deleted=0 ORDER BY creationdate DESC LIMIT 1");
        $statement->bindValue(":userid", $userid);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
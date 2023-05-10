<?php class Announcement{
    public static function getAllCitygroupAnnouncements($citygroupid){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM announcements WHERE active=1 AND deleted=0 AND citygroup_id=$citygroupid ORDER BY creationdate DESC");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getAllProjectAnnouncements($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM announcements WHERE active=1 AND deleted=0 AND project_id=:id ORDER BY creationdate DESC");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
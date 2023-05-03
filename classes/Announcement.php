<?php class Announcement{
    public static function getAllAnnouncements(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM announcements WHERE active=1 AND deleted=0 ORDER BY creationdate DESC");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
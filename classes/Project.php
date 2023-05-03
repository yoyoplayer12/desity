<?php class Project{
    public static function getAllSearchingProjects(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM projects WHERE active=1 AND needsthinkers=1 AND deleted=0");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
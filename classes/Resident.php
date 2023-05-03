<?php class Resident{
    public static function getResident($adminplaceid){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM users WHERE city_id=:adminplaceid AND active=1 AND admin=0");
        $statement->bindValue(":adminplaceid", $adminplaceid);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
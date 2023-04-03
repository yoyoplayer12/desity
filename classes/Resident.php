<?php class Resident{
    public static function getResident($adminplace){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM users WHERE place=:adminplace AND active=1 AND admin=0");
        $statement->bindValue(":adminplace", $adminplace);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
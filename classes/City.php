<?php class City{
    public static function getCity(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM city WHERE active=1 ORDER BY city ASC");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getCityById($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM city WHERE id=:id AND active=1");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
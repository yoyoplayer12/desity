<?php class City{
    public static function getCity(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM city WHERE active=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
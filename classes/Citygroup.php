<?php class Citygroup{
    private $name;
    public static function getCityByGroup($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM city WHERE citygroup_id=:id AND active=1");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getAllCitygroups(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM citygroups WHERE active=1 ORDER BY name ASC");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function setName($name){
        $this->name = $name;
        return $this;
    }
    public function save(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO citygroups(`name`) VALUES(:name)");
        $statement->bindValue(":name", $this->name);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
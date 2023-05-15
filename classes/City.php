<?php class City{
    private $name;
    private $cityPic;
    private $cityGroupId;
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
    public function setName($name){
        $this->name = $name;
        return $this;
    }
    public function setCityPic($cityPic){
        $this->cityPic = $cityPic;
        return $this;
    }
    public function setCityGroupId($id){
        $this->cityGroupId = $id;
        return $this;
    }
    public function save(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO city(`citygroup_id`, `city`, `city-pic`) VALUES(:groupid, :name, :citypic)");
        $statement->bindValue(":name", $this->name);
        $statement->bindValue(":citypic", $this->cityPic);
        $statement->bindValue(":groupid", $this->cityGroupId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getRandomStringRamdomInt($length = 16){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
<?php class User{
    private string $firstname;
    private string $lastname;
    private string $cityId;
    private string $email;
    private string $password;
    private string $profileImage;
    private string $adress;
    private string $dob;

    public function setFirstname($firstname){
        $this->firstname = $firstname;
        return $this;
    }
    public function setLastname($lastname){
        $this->lastname = $lastname;
        return $this;
    }
    public function setCityId($id){
        $this->cityId = $id;
        return $this;
    }
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }
    public function setPassword($password){
        $this->password = $password;
        return $this;
    }
    public function setProfileImage($image){
        $this->profileImage = $image;
        return $this;
    }
    public function setAdress($adress){
        $this->adress = $adress;
        return $this;
    }
    public function setDob($dob){
        $this->dob = $dob;
        return $this;
    }
    public function getUser(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT `email` FROM users WHERE email = :email");
        $statement->bindValue(":email", $this->email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function setUser(){
		try {
			$conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO users(`firstname`, `lastname`, `photo_url`, `city_id`, `adress`, `email`, `password`, `dob`) VALUES (:firstname,:lastname,:image,:cityid,:adress,:email,:password,:dob)");
            $statement->bindValue(":firstname", $this->firstname);
            $statement->bindValue(":lastname", $this->lastname);
            $statement->bindValue(":image", $this->profileImage);
            $statement->bindValue(":cityid", $this->cityId);
            $statement->bindValue(":adress", $this->adress);
            $statement->bindValue(":email", $this->email);
            $statement->bindValue(":password", $this->password);
            $statement->bindValue(":dob", $this->dob);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
		}
		catch(Throwable $e){
			echo $e->getMessage();
		}
    }
}
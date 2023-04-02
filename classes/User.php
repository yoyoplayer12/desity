<?php class User{
    private string $firstname;
    private string $lastname;
    private string $place;
    private string $email;
    private string $password;
    public function setFirstname($firstname){
        $this->firstname = $firstname;
        return $this;
    }
    public function setLastname($lastname){
        $this->lastname = $lastname;
        return $this;
    }
    public function setPlace($place){
        $this->place = $place;
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
    public function setUser(){
		try {
			$conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO users(`firstname`, `lastname`, `photo_url`, `place`, `email`, `password`) VALUES (:firstname,:lastname,'https://picsum.photos/200',:place,:email,:password)");
            $statement->bindValue(":firstname", $this->firstname);
            $statement->bindValue(":lastname", $this->lastname);
            $statement->bindValue(":place", $this->place);
            $statement->bindValue(":email", $this->email);
            $statement->bindValue(":password", $this->password);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
		}
		catch(Throwable $e){
			echo $e->getMessage();
		}
    }
}
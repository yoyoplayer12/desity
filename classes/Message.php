<?php class Message{
    private $senderId;
    private $receiverId;
    private $content;
    private $projectid;
    public static function getMessagesByUser($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM messages WHERE receiver_id=:id OR sender_id=:id AND active=1 AND deleted=0 ORDER BY senddate ASC");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function setSenderId($senderId){
        $this->senderId = $senderId;
        return $this;
    }
    public function setReceiverId($receiverId){
        $this->receiverId = $receiverId;
        return $this;
    }
    public function setContent($content){
        $this->content = $content;
        return $this;
    }
    public function setProjectId($projectid){
        $this->projectid = $projectid;
        return $this;
    }
    public function setMessage(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO messages(`sender_id`, `receiver_id`, `content`) VALUES (:senderid,:receiverid,:content)");
        $statement->bindValue(":senderid", $this->senderId);
        $statement->bindValue(":receiverid", $this->receiverId);
        $statement->bindValue(":content", $this->content);
        $statement->execute();
    }
    public function setProjectMessage(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO messages(`sender_id`, `project_id`, `content`) VALUES (:senderid,:projectid,:content)");
        $statement->bindValue(":senderid", $this->senderId);
        $statement->bindValue(":projectid", $this->projectid);
        $statement->bindValue(":content", $this->content);
        $statement->execute();
    }
    public static function getMessagesByProject($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM messages WHERE project_id=:id AND active=1 AND deleted=0 ORDER BY senddate ASC");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetchAll();
    }
}
<?php
// Establish database connection
require_once('../bootstrap.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $pid = $_POST['pid'];

    // Insert the new message into the database
    $conn = Db::getInstance();
    $statement = $conn->prepare("INSERT INTO messages(`sender_id`, `project_id`, `content`) VALUES (:senderid,:projectid,:content)");
    $statement->bindValue(":senderid", $_SESSION['userid']);
    $statement->bindValue(":projectid", $pid);
    $statement->bindValue(":content", $message);
    $statement->execute();
}
?>

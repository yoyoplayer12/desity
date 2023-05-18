<?php
// Establish database connection
// Perform query to retrieve chat messages
// Fetch the rows and generate HTML for displaying the messages
require_once('../bootstrap.php');


$conn = Db::getInstance();
$statement = $conn->prepare("SELECT * FROM messages WHERE project_id=:id AND active=1 AND deleted=0 ORDER BY senddate DESC LIMIT 1");
$statement->bindValue(":id", $id);
$statement->execute();
$resilts = $statement->fetch();
$html = '<p>'.$results['content'].'</p>';

// Echo the HTML content
echo $html;
?>
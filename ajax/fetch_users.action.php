<?php
// Establish database connection
// Perform query to retrieve connected users
// Fetch the rows and generate HTML for displaying the users
require_once('../bootstrap.php');

$conn = Db::getInstance();
$statement = $conn->prepare("SELECT DISTINCT sender_id FROM messages WHERE active=1 AND deleted=0");
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_COLUMN);
$html = '';
foreach ($users as $user) {
    $html .= "<li>$user</li>";
}

// Echo the HTML content
echo $html;
?>

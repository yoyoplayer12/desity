<?php
// Establish database connection
// Perform query to retrieve chat messages
// Fetch the rows and generate HTML for displaying the messages
require_once('../bootstrap.php');

$conn = Db::getInstance();
$statement = $conn->prepare("SELECT * FROM messages WHERE active=1 AND deleted=0 ORDER BY senddate ASC");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
$html = '';
foreach ($results as $result) {
    $sender = $result['sender_id'];
    $text = $result['content'];
    $timestamp = $result['senddate'];

    $html .= "<div><strong>$sender:</strong> $text <span class='timestamp'>$timestamp</span></div>";
}

// Echo the HTML content
echo $html;
?>

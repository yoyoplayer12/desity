<?php
// Establish database connection
// Perform query to retrieve chat messages
// Fetch the rows and generate HTML for displaying the messages
require_once('../bootstrap.php');

$conn = Db::getInstance();
$statement = $conn->prepare("SELECT * FROM messages WHERE active=1 AND deleted=0 AND project_id=:pid ORDER BY senddate ASC");
$statement->bindValue(":pid", $_GET['pid']);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
$html = '';
foreach ($results as $result) {
    $sender = $result['sender_id'];
    $text = $result['content'];
    $timestamp = $result['senddate'];
    $time = date('d M Y', strtotime($timestamp))." at ".date('H:i', strtotime($timestamp));
    $selectedprojectid = $_SESSION['selectedid'];
    
    $user = User::getUsersById($sender);

    $firstname = $user['firstname'];
    $lastname = $user['lastname'];
    $avatar = $user['photo_url'];
    if($user['admin'] == 1){
        $html .= "
        <div class='chatmessage-chat-me'>
            <div class='pic-chat' style='background-image: url($avatar);'></div>
            <div class='nametag-chat' style='margin-left: 16px;'>
                <p class='body-bold-Large adminchat' style='margin: 0;vertical-align:center'>$firstname $lastname</p>
                <p class='body-small charcoal date-chat'>$time</p>
                <p class='body-normal messagecontent-chat' style='margin-top: 8px; margin-bottom: 0;' id='chat-messages'>$text</p>
            </div>    
        </div>
        
        ";
    }
    else{
        $html .= "
        <div class='chatmessage-chat-me'>
            <div class='pic-chat' style='background-image: url($avatar);'></div>
            <div class='nametag-chat' style='margin-left: 16px;'>
            <p class='body-bold-Large chatuser' style='margin: 0;'>$firstname $lastname</p>
            <p class='body-small charcoal date-chat'>$time</p>
            <p class='body-normal messagecontent-chat' style='margin-top: 8px; margin-bottom: 0;' id='chat-messages'>$text</p>
            </div>    
        </div>
        
        ";
    }
}

// Echo the HTML content
echo $html;
?>
<?php
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    if(isset($_SESSION["loggedin"])) {
    }
    else{
        header("Location: ./login.php");
    }
    $allusermessages = Message::getMessagesByUser($_SESSION['userid']);
    $allthinkerprojects = Thinker::getAllUserProjects($_SESSION['userid']);
    if (isset($_GET['id'])) {
        $selectedid = $_GET['id'];
    }
    elseif(isset($_GET['pid'])){
        $thinkersbyprojectid = Thinker::getAllThinkersByProject($_GET['pid']);
        foreach($thinkersbyprojectid as $thinker){
            if($_SESSION['userid'] == $thinker['user_id']){
                $selectedid = $_GET['pid'];
            }
            else{
            }
        }
        
        
    }
    else{
    }
    if(!empty($_POST)){
        if(isset($_POST['send'])){
            if(isset($_GET['id'])){
                $message = new Message();
                $message->setSenderId($_SESSION['userid']);
                $message->setReceiverId($selectedid);
                $message->setContent($_POST['text']);
                $message->setMessage();
                header("Location: ./chat.php?id=$selectedid");
            }
            elseif(isset($_GET['pid'])){
                $message = new Message();
                $message->setSenderId($_SESSION['userid']);
                $message->setProjectId($selectedid);
                $message->setContent($_POST['text']);
                $message->setProjectMessage();
                header("Location: ./chat.php?pid=$selectedid");
            }
            else{
            }
            
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="assets/brand/tabicon.svg" style="height:40px" type="image/svg">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Dashboard - Chat</title>
</head>
<body>
    <?php include_once(__DIR__ . "/navs/dashnav.php"); ?>
    <div class="chat">
        <div class="top-chat">
            <h5>CHAT</h5>
        </div>
        <div class="contactbox-chat">
            <input type="text" placeholder="Search" class="chatsearch">
            <div class="contacts-chat">
                <p class="body-small contacttitle">Projects</p>
                <?php foreach($allthinkerprojects as $ids): ?>
                    <?php $project = Project::getProjectById($ids['project_id']); ?>
                    <a class="user-chat" href="chat.php?pid=<?php echo $project["id"]?>">
                        <div class="user-image-chat" style="background-image: url(<?php echo $project['img-url'] ?>);"></div>
                        <div class="titlecontainer-chat"><p class="body-normal"><?php echo $project['title'] ?></p></div>
                        <p class="body-xs lastmessage">laatste bericht</p>
                    </a>
                <?php endforeach; ?>
                <p class="body-small contacttitle">Personal messages</p>
            </div>
        </div>
        <div class="chatbox-chat">

                    <!-- personal messages -->

        <?php if(isset($_GET["id"]) && isset($selectedid)): ?>
            <?php foreach($allusermessages as $message): ?>
                <?php $sender = User::getUsersById($message['sender_id']) ?>

                    <!-- Your messages -->
                    <?php if($message['sender_id'] == $_SESSION['userid'] && $message['receiver_id'] == $selectedid): ?>
                        <div class="chatmessage-chat-me">
                            <div class="pic-chat" style="background-image: url('<?php echo $sender['photo_url'] ?>');"></div>
                            <div class="nametag-chat" style="margin-left: 16px;">
                                <?php if($sender['admin'] == 1): ?>
                                    <p class="body-bold-Large adminchat" style="margin: 0;"><?php echo $sender['firstname']." ".$sender['lastname'] ?></p>
                                    <p class="body-small charcoal date-chat"><?php echo " ".date('d M Y', strtotime($message['senddate']))." at ".date('H:i', strtotime($message['senddate'])) ?></p>
                                <?php else: ?>
                                    <p class="body-bold-Large" style="margin: 0;"><?php echo $sender['firstname']." ".$sender['lastname'] ?></p>
                                    <p class="body-small charcoal date-chat"><?php echo " ".date('d M Y', strtotime($message['senddate']))." at ".date('H:i', strtotime($message['senddate'])) ?></p>
                                <?php endif; ?>
                                <p class="body-normal messagecontent-chat" style="margin-top: 8px; margin-bottom: 0;" id="chat-messages"></p>
                            </div>
                            
                        </div>
                    
                    <!-- Other people's messages -->
                    <?php elseif($message['receiver_id'] == $_SESSION['userid'] && $message['sender_id'] == $selectedid):?>
                    <div class="chatmessage-chat-other">
                        <div class="pic-chat" style="background-image: url('<?php echo $sender['photo_url'] ?>');"></div>
                        <div class="nametag-chat" style="margin-left: 16px;">
                                <?php if($sender['admin'] == 1): ?>
                                    <p class="body-bold-Large adminchat" style="margin: 0;"><?php echo $sender['firstname']." ".$sender['lastname'] ?></p>
                                    <p class="body-small charcoal date-chat"><?php echo " ".date('d M Y', strtotime($message['senddate']))." at ".date('H:i', strtotime($message['senddate'])) ?></p>
                                <?php else: ?>
                                    <p class="body-bold-Large" style="margin: 0;"><?php echo $sender['firstname']." ".$sender['lastname'] ?></p>
                                    <p class="body-small charcoal date-chat"><?php echo " ".date('d M Y', strtotime($message['senddate']))." at ".date('H:i', strtotime($message['senddate'])) ?></p>
                                <?php endif; ?>
                                <p class="body-normal messagecontent-chat" style="margin-top: 8px; margin-bottom: 0;" id="chat-messages"></p>
                            </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>

                                    <!-- group messages -->

        <?php elseif(isset($_GET["pid"]) && isset($selectedid)): ?>
            <?php $allgroupmessages = Message::getMessagesByProject($_GET['pid']);?>
            <?php foreach($allgroupmessages as $message):?>
                <?php $sender = User::getUsersById($message['sender_id']) ?>
                    <!-- Your messages -->
                <?php if($message['sender_id'] == $_SESSION['userid'] && $message['project_id'] == $selectedid): ?>
                    <div class="chatmessage-chat-me">
                        <div class="pic-chat" style="background-image: url('<?php echo $sender['photo_url'] ?>');"></div>
                        <div class="nametag-chat" style="margin-left: 16px;">
                            <?php if($sender['admin'] == 1): ?>
                            <p class="body-bold-Large adminchat" style="margin: 0;"><?php echo $sender['firstname']." ".$sender['lastname'] ?></p>
                            <p class="body-small charcoal date-chat"><?php echo " ".date('d M Y', strtotime($message['senddate']))." at ".date('H:i', strtotime($message['senddate'])) ?></p>
                            <?php else: ?>
                                <p class="body-bold-Large" style="margin: 0;"><?php echo $sender['firstname']." ".$sender['lastname'] ?></p>
                                <p class="body-small charcoal date-chat"><?php echo " ".date('d M Y', strtotime($message['senddate']))." at ".date('H:i', strtotime($message['senddate'])) ?></p>
                            <?php endif; ?>
                            <p class="body-normal messagecontent-chat" style="margin-top: 8px; margin-bottom: 0;" id="chat-messages"></p>
                        </div>            
                    </div>
                    <!-- Other people's messages -->
                    <?php elseif($message['project_id'] == $selectedid):?>
                        <div class="chatmessage-chat-other">
                            <div class="pic-chat" style="background-image: url('<?php echo $sender['photo_url'] ?>');"></div>
                            <div class="nametag-chat" style="margin-left: 16px;">
                                <?php if($sender['admin'] == 1): ?>
                                <p class="body-bold-Large adminchat" style="margin: 0;"><?php echo $sender['firstname']." ".$sender['lastname'] ?></p>
                                <p class="body-small charcoal date-chat"><?php echo " ".date('d M Y', strtotime($message['senddate']))." at ".date('H:i', strtotime($message['senddate'])) ?></p>
                                <?php else: ?>
                                <p class="body-bold-Large" style="margin: 0;"><?php echo $sender['firstname']." ".$sender['lastname'] ?></p>
                                <p class="body-small charcoal date-chat"><?php echo " ".date('d M Y', strtotime($message['senddate']))." at ".date('H:i', strtotime($message['senddate'])) ?></p>
                                <?php endif; ?>
                                <p class="body-normal messagecontent-chat" style="margin-top: 8px; margin-bottom: 0;" id="chat-messages"></p>
                            </div>
                        </div>
                    <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
                <!-- no message -->
        <?php endif; ?>
        </div>
        <div class="sendpart">
        <?php if(isset($selectedid)): ?>
            <form action="" method="post">
                <input type="text" name="text" class="send-chat" placeholder="Aa"></input>
                <input type="submit" value=">" name="send" class="send">
            </form>
        <?php endif; ?>
        </div>
    </div>
</body>
<script>
        $(document).ready(function() {
        // Function to fetch and display the chat messages
        function fetchChatMessages() {
            $.ajax({
                url: 'ajax/fetch_messages.action.php',
                method: 'GET',
                success: function(response) {
                    $('#chat-messages').html(response);
                    console.log($('#chat-messages').html(response));
                }
            });
        }

        // Function to fetch and display the list of connected users
        // function fetchUserList() {
        //     $.ajax({
        //         url: 'fetch_users.action.php',
        //         method: 'GET',
        //         success: function(response) {
        //             $('#user-list').html(response);
        //         }
        //     });
        // }

        // Call the initial fetch functions
        fetchChatMessages();
        // fetchUserList();

        // Handle form submission
        // $('#chat-form').submit(function(event) {
        //     event.preventDefault();

        //     var message = $('#message-input').val();

        //     $.ajax({
        //         url: 'send_message.action.php',
        //         method: 'POST',
        //         data: { message: message },
        //         success: function() {
        //             $('#message-input').val('');
        //             fetchChatMessages();
        //         }
        //     });
        // });

        // Periodically update the chat messages and user list
        setInterval(function() {
            fetchChatMessages();
            // fetchUserList();
        }, 5000); // Adjust the interval as needed
    });

    </script>
</html>
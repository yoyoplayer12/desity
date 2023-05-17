<?php
    ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    $selectedid="";
    if(isset($_SESSION["loggedin"])) {
    }
    else{
        header("Location: ./login.php");
    }
    $allthinkerprojects = Thinker::getAllUserProjects($_SESSION['userid']);
    if (isset($_GET['id'])) {
        //nog beveiligen
        $selectedid = $_GET['id'];
        //nog beveiligen
    }
    elseif(isset($_GET['pid'])){
        $thinkersbyprojectid = Thinker::getAllThinkersByProject($_GET['pid']);
        foreach($thinkersbyprojectid as $thinker){
            if($_SESSION['userid'] == $thinker['user_id']){
                $selectedid = $_GET['pid'];
                $_SESSION['selectedid'] = $selectedid;
            }
            else{
            }
        }
        
        
    }
    else{
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


        
        <?php if($selectedid == $_GET['pid'] || $selectedid == $_GET['id'] ): ?>
            <div id="chat-container" class="chatbox-chat">
                <div id="chat-messages"></div>
            </div>
            <div class="sendpart">
                <?php if(isset($selectedid)):?>
                    <form id="chat-form" action="" method="post">
                        <input type="text" name="text" id="message-input" class="send-chat" placeholder="Aa"></input>
                        <input type="submit" value="Send" name="send" class="send">
                    </form>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <!-- <div id="user-list-container">
            <h3>Connected Users</h3>
            <ul id="user-list"></ul>
        </div> -->
    </div>
</body>


<script>
    function scrollToBottom() {
        var chatMessages = document.getElementById('chat-container');
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    $(document).ready(function() {
    // Function to fetch and display the chat messages
    function fetchChatMessages() {
        pid = 1; //deze nog aanpassen
        $.ajax({
            url: 'ajax/fetch_messages.action.php?pid='+ pid,
            method: 'GET',
            success: function(response) {
                $('#chat-messages').html(response);
                scrollToBottom();
            }
        });
    }
    function fetchChatUsers() {
        pid = 1; //deze nog aanpassen
        $.ajax({
            url: 'ajax/fetch_messages.action.php?pid='+ pid,
            method: 'GET',
            success: function(response) {
                $('#chat-messages').html(response);
            }
        });
    }
    // Function to fetch and display the list of connected users
    // function fetchUserList() {
    //     $.ajax({
    //         url: 'ajax/fetch_users.action.php',
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
    $('#chat-form').submit(function(event) {
        event.preventDefault();

        var message = $('#message-input').val();

//deze nog aanpassen

        var pid = 1; 

//deze nog aanpassen
        $.ajax({
            url: 'ajax/send_message.action.php',
            method: 'POST',
            data: { message: message, pid: pid },
            success: function() {
                $('#message-input').val('');
                fetchChatMessages();
                scrollToBottom();
            }
        });
    });

    // Periodically update the chat messages and user list
    setInterval(function() {
        fetchChatMessages();
        // fetchUserList();
    }, 5000); // Adjust the interval as needed
});

</script>
</html>

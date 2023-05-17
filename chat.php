<?php
    // ini_set('display_errors', 1);
    include_once(__DIR__ . "/bootstrap.php");
    if(isset($_SESSION["loggedin"])) {
    }
    else{
        header("Location: ./login.php");
    }
    $allthinkerprojects = Thinker::getAllActiveUserProjects($_SESSION['userid']);
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
                echo "<script>";
                echo "var projectId = '" . addslashes($selectedid) . "';";
                echo "</script>";
            }
            else{
            }
        }
    }
    else{
        $firstprojectid = Project::getFirstUserProjectId($_SESSION['userid']);
        if($firstprojectid == ""){
        }
        else{
            $id = $firstprojectid['id'];
            header("Location: chat.php?pid=$id");
        }
        
    }
    $image = new Image();
    $url = $image->getUrl();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="<?php echo $url."assets/brand/ppyo2h0le7ysvsembls6" ?>" style="height:40px" type="image/svg">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <title>Dashboard - Chat</title>
</head>
<body>
    <?php include_once(__DIR__ . "/navs/dashnav.php"); ?>
    <div class="chat">
        <div class="top-chat">
        <?php if(isset($selectedid)): ?>
            <?php if($selectedid == $_GET['pid']): ?>
                <?php $project = Project::getIdActiveProject($selectedid); ?>
                <h5 style="text-transform: uppercase">CHAT: <?php echo $project['title'] ?></h5>
            <?php elseif($selectedid == $_GET['id'] ): ?>
                <!-- for pms -->
            <?php endif;?>
        <?php else:?>
            <h5>CHAT</h5>
        <?php endif; ?>
        </div>
        <div class="contactbox-chat">
            <input type="text" placeholder="Search" class="chatsearch">
            <div class="contacts-chat">
                <p class="body-small contacttitle">Projects</p>
                <?php foreach($allthinkerprojects as $project): ?>
                    <?php $lastmessage = Message::getLastMessageByProject($project['id']) ?>
                    <?php if(isset($lastmessage['content'])): ?>
                        <?php $dots = strlen($lastmessage['content']) > 20 ? "..." : "" ?>
                    <?php endif; ?>
                    <?php if(isset($_GET['pid'])): ?>
                        <?php if($_GET['pid'] == $project["id"]): ?>
                            <a class="user-chat selected-chat" href="chat.php?pid=<?php echo $project["id"]?>">
                                <div class="user-image-chat" style="background-image: url(<?php echo $url.$project['img-url'] ?>);"></div>
                                <div class="titlecontainer-chat"><p class="body-normal"><?php echo $project['title'] ?></p></div>
                                <?php if(isset($lastmessage['content'])): ?>
                                    <p class="body-xs lastmessage"><?php echo substr($lastmessage['content'], 0, 20).$dots ?></p>
                                <?php else: ?>
                                    <p class="body-xs lastmessage">No messages yet</p>
                                <?php endif; ?>
                            </a>
                        <?php else: ?>
                            <a class="user-chat" href="chat.php?pid=<?php echo $project["id"]?>">
                                <div class="user-image-chat" style="background-image: url(<?php echo $url.$project['img-url'] ?>);"></div>
                                <div class="titlecontainer-chat"><p class="body-normal"><?php echo $project['title'] ?></p></div>
                                <?php if(isset($lastmessage['content'])): ?>
                                    <p class="body-xs lastmessage"><?php echo substr($lastmessage['content'], 0, 20).$dots ?></p>
                                <?php else: ?>
                                    <p class="body-xs lastmessage">No messages yet</p>
                                <?php endif; ?>
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a class="user-chat" href="chat.php?pid=<?php echo $project["id"]?>">
                            <div class="user-image-chat" style="background-image: url(<?php echo $url.$project['img-url'] ?>);"></div>
                            <div class="titlecontainer-chat"><p class="body-normal"><?php echo $project['title'] ?></p></div>
                            <?php if(isset($lastmessage['content'])): ?>
                                <p class="body-xs lastmessage"><?php echo substr($lastmessage['content'], 0, 20).$dots ?></p>
                            <?php else: ?>
                                <p class="body-xs lastmessage">No messages yet</p>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
                <p class="body-small contacttitle">Personal messages</p>
            </div>
        </div>


        <?php if(isset($selectedid)):?>
            <?php if($selectedid == $_GET['pid']): ?>
                <div id="chat-container" class="chatbox-chat">
                    <div id="chat-messages"></div>
                </div>
                <div class="sendpart">
                    <form id="chat-form" action="" method="post">
                        <input type="text" name="text" id="message-input" class="send-chat" placeholder="Aa"></input>
                        <input type="submit" value="Send" name="send" class="send">
                    </form>
                </div>
            <?php endif; ?>
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
    pid = projectId;
    $(document).ready(function() {
    // Function to fetch and display the chat messages
    function fetchChatGroupMessages() {
        $.ajax({
            url: 'ajax/fetch_messages.action.php?pid='+ pid,
            method: 'GET',
            success: function(response) {
                $('#chat-messages').html(response);
                scrollToBottom();
            }
        });
    }
    // function fetchChatPersonalMessages() {
    //     $.ajax({
    //         url: 'ajax/fetch_messages.action.php?pid='+ pid,
    //         method: 'GET',
    //         success: function(response) {
    //             $('#chat-messages').html(response);
    //         }
    //     });
    // }

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
    fetchChatGroupMessages();
    // fetchUserList();
    // Handle form submission
    $('#chat-form').submit(function(event) {
        event.preventDefault();
        message = $('#message-input').val();
        $.ajax({
            url: 'ajax/send_message.action.php',
            method: 'POST',
            data: { message: message, pid: pid },
            success: function() {
                $('#message-input').val('');
                fetchChatGroupMessages();
                scrollToBottom();
            }
        });
    });

    // Periodically update the chat messages and user list
    setInterval(function() {
        fetchChatGroupMessages();
        // fetchUserList();
    }, 1000); // Adjust the interval as needed
});

</script>
</html>

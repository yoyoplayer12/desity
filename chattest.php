<!DOCTYPE html>
<html>
<head>
    <title>Ajax Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Ajax Chat</h1>

    <div id="chat-container">
        <div id="chat-messages"></div>
        <form id="chat-form">
            <input type="text" id="message-input" placeholder="Enter your message" />
            <button type="submit">Send</button>
        </form>
    </div>

    <div id="user-list-container">
        <h3>Connected Users</h3>
        <ul id="user-list"></ul>
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
            }
        });
    }

    // Function to fetch and display the list of connected users
    function fetchUserList() {
        $.ajax({
            url: 'ajax/fetch_users.action.php',
            method: 'GET',
            success: function(response) {
                $('#user-list').html(response);
            }
        });
    }

    // Call the initial fetch functions
    fetchChatMessages();
    fetchUserList();

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
                console.log('Message sent successfully');
            }
        });
    });

    // Periodically update the chat messages and user list
    setInterval(function() {
        fetchChatMessages();
        fetchUserList();
    }, 5000); // Adjust the interval as needed
});

</script>
</html>

<!DOCTYPE html>
<html>
    <head>
        <title>Message</title>
        <link rel = "stylesheet" href = "static/css/messageEach.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src = "static/js/default.js"></script>
    </head>
    <body>
        <nav class = "message_nav">
            <a href = "index.php?filename=message">
                <img class = "back" src = "static/assets/back.png" alt = "back"></a>
            <img class = "profile" alt = "profile" src = "static/assets/default.png" onerror = "this.src = 'static/assets/default.png'">
            <h3 class = "profile_user">User</h3>
        </nav>
        <div class = "conversation">
            
        </div>
        <div class = "message_box">
            <input type = "text" class = "message_input" placeholder = "Type a message">
            <input class = "send" type = "image" src = "static/assets/send.png">
        </div>
        <script src = "static/js/messageEach.js"></script>
    </body>
</html>
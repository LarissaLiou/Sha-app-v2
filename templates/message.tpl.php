<!DOCTYPE html>
<html>
    <head>
        <title>Message</title>
        <link rel = "stylesheet" href = "static/css/message.css">
        <link rel = "stylesheet" href = "static/css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src = "static/js/default.js"></script>
    </head>

    <body>
        <div class="container">

        
        <section>
            <div id = "header">
                <a href = "index.php?filename=home" id = "goBack"><span class = "mediumSize">🡰</span></a>&nbsp;&nbsp;&nbsp;
                <h1>Messages</h1>
                <!-- <img id = "headerIcon" src = "static/assets/share.png"> -->
            </div>
        </section>

        <!-- <section>
            <h2><b>Active now</b></h2>
            <div id = "peopleActive">
                <a href = "index.php?filename=messageEach"><img class = "eachPerson" src = "static/assets/pfp2.jpeg"></a>
                <a href = "index.php?filename=messageEach"><img class = "eachPerson" src = "static/assets/pfp2.jpeg"></a>
                <a href = "index.php?filename=messageEach"><img class = "eachPerson" src = "static/assets/pfp2.jpeg"></a>
                <a href = "index.php?filename=messageEach"><img class = "eachPerson" src = "static/assets/pfp2.jpeg"></a>
                <a href = "index.php?filename=messageEach"><img class = "eachPerson" src = "static/assets/pfp2.jpeg"></a>
                <a href = "index.php?filename=messageEach"><img class = "eachPerson" src = "static/assets/pfp2.jpeg"></a>
                <a href = "index.php?filename=messageEach"><img class = "eachPerson" src = "static/assets/pfp2.jpeg"></a>
            </div>
        </section> -->

        <section>
            <button id = "message" class = "button">Direct Message</button>
            <!-- <button id = "event" class = "button" disabled>Event Channels</button> -->
            <button id = "request" class = "button" >Requests</button>
        </section>

        <section id = "messageContent">
        </section>

        <section id = "requestContent">
        </section>

        </div>
        <script src = "static/js/message.js"></script>
    </body>
</html>
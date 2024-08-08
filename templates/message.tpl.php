<!DOCTYPE html>
<html>
    <head>
        <title>Message</title>
        <link rel = "stylesheet" href = "static/css/message.css">
        <link rel = "stylesheet" href = "static/css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <section>
            <div id = "header">
                <a href = "index.php?filename=home" id = "goBack"><span class = "mediumSize">🡰</span></a>&nbsp;&nbsp;&nbsp;
                <h1>Messages</h1>
                <img id = "headerIcon" src = "static/assets/share.png">
            </div>
        </section>

        <section>
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
        </section>

        <section>
            <button id = "message" class = "button">Direct Message</button>
            <button id = "event" class = "button" disabled>Event Channels</button>
            <button id = "request" class = "button" >Requests</button>
        </section>

        <section id = "messageContent">
            <div class = "messageGrid">
                <img src = "static/assets/pfp2.jpeg" class = "messagePfp eachPerson grid-items">
                <p class = "messageName grid-items">Shanice</p>
                <p class = "messagePreview grid-items">Lorem ipsum dolor sit ametsfnnajsjjfn...</p>
                <p class = "messageTime grid-items">1m</p>
            </div>

            <div class = "messageGrid">
                <img src = "static/assets/pfp2.jpeg" class = "messagePfp eachPerson grid-items">
                <p class = "messageName grid-items">Shanice</p>
                <p class = "messagePreview grid-items">Lorem ipsum dolor sit ametsfnnajsjjfn...</p>
                <p class = "messageTime grid-items">1m</p>
            </div>

            <div class = "messageGrid">
                <img src = "static/assets/pfp2.jpeg" class = "messagePfp eachPerson grid-items">
                <p class = "messageName grid-items">Shanice</p>
                <p class = "messagePreview grid-items">Lorem ipsum dolor sit ametsfnnajsjjfn...</p>
                <p class = "messageTime grid-items">1m</p>
            </div>

            <div class = "messageGrid">
                <img src = "static/assets/pfp2.jpeg" class = "messagePfp eachPerson grid-items">
                <p class = "messageName grid-items">Shanice</p>
                <p class = "messagePreview grid-items">Lorem ipsum dolor sit ametsfnnajsjjfn...</p>
                <p class = "messageTime grid-items">1m</p>
            </div>
        </section>

        <section id = "requestContent">
        <div class = "requestGrid">
                <img src = "static/assets/pfp2.jpeg" class = "messagePfp eachPerson grid-items">
                <p class = "requestName grid-items">Shanice</p>
                <p class = "requestPreview grid-items">Lorem ipsum dolor sit ametsfnnajsjjfn...</p>
                <p class = "requestTime grid-items">1m</p>
                <button class = "requestAccept">Accept</button>
                <button class = "requestDecline">Decline</button>
            </div>

            <div class = "requestGrid">
                <img src = "static/assets/pfp2.jpeg" class = "messagePfp eachPerson grid-items">
                <p class = "requestName grid-items">Shanice</p>
                <p class = "requestPreview grid-items">Lorem ipsum dolor sit ametsfnnajsjjfn...</p>
                <p class = "requestTime grid-items">1m</p>
                <button class = "requestAccept">Accept</button>
                <button class = "requestDecline">Decline</button>
            </div>

            <div class = "requestGrid">
                <img src = "static/assets/pfp2.jpeg" class = "messagePfp eachPerson grid-items">
                <p class = "requestName grid-items">Shanice</p>
                <p class = "requestPreview grid-items">Lorem ipsum dolor sit ametsfnnajsjjfn...</p>
                <p class = "requestTime grid-items">1m</p>
                <button class = "requestAccept">Accept</button>
                <button class = "requestDecline">Decline</button>
            </div>

            <div class = "requestGrid">
                <img src = "static/assets/pfp2.jpeg" class = "messagePfp eachPerson grid-items">
                <p class = "requestName grid-items">Shanice</p>
                <p class = "requestPreview grid-items">Lorem ipsum dolor sit ametsfnnajsjjfn...</p>
                <p class = "requestTime grid-items">1m</p>
                <button class = "requestAccept">Accept</button>
                <button class = "requestDecline">Decline</button>
            </div>
        </section>


        <script src = "static/js/message.js"></script>
    </body>
</html>
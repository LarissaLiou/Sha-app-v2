<!DOCTYPE html>
<html>
    <head>
        <title>Event Information</title>
        <link rel = "stylesheet" href = "static/css/eventInformation.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src = "static/js/default.js"></script>
    </head>

    <body>
        <section class = "container">
            <div id = "header">
                <a href = "index.php?filename=home" id = "goBack"><span class = "mediumSize">🡰</span></a>
                <a href = "index.php?filename=notification"><img class = "headerIcons" src = 'static/assets/notificationIcon.png'></a>
                <a href = "index.php?filename=message"><img class = "headerIcons" src = 'static/assets/messageIcon.png'></a>
            </div>

            <div class = "flex">
                <img id = "eventImage" src = "static/assets/pfp2.jpeg">
            </div>

            <div>
                <h2 class = "eventName">Event1</h2>
                <!-- <span class="icon" class = "blue">UI-UX</span>
                <span class="icon" class = "green">Sustainability</span> -->
            </div>

            <div>
                <img class = "smallIcons" src = "static/assets/person.png">
                <span id = "eventAttendees">200 - 500 attendees</span>
            </div>

            <div>
                <img class = "smallIcons" src = "static/assets/ticket.png">
                <span id = "eventPrice">$10-$200</span>
            </div>

            <div>
                <img class = "smallIcons" src = "static/assets/locationIcon.png">
                <span id = "eventLocation">Singapore Management University, Singapore</span>
            <div>

            <div>
                <img class = "smallIcons" src = "static/assets/calendarIcon.png">
                <span id = "eventDate">June 8, 2024</span>
            <div class = "marginpls" id = "eventDescription">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>

            <button class = "button" id = "register">Register</button>
            <button class = "button" id = "visit">Visit Event Page</button>
        </section>
        <script src = 'static/js/eventInformation.js'></script>
    </body>
</html>
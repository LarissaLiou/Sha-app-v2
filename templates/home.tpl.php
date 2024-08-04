<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
        <link rel = "stylesheet" href = "static/css/home.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <section>
            <h1 id = "companyTitle">Sociate</h1>
            <a href = "index.php?filename=notification"><img class = "headerIcons" src = 'static/assets/notificationIcon.png'></a>
            <a href = "index.php?filename=message"><img class = "headerIcons" src = 'static/assets/messageIcon.png'></a>
        </section>

        <section>
            <p class = "bold">Discover</p>
            <div class = "flexleft">
                <img class = "discoverimage" src = "static/assets/pfp.jpeg">
                <img class = "discoverimage" src = "static/assets/pfp.jpeg">
                <img class = "discoverimage" src = "static/assets/pfp.jpeg">
                <img class = "discoverimage" src = "static/assets/pfp.jpeg">
                <img class = "discoverimage" src = "static/assets/pfp.jpeg">
                <img class = "discoverimage" src = "static/assets/pfp.jpeg">
                <img class = "discoverimage" src = "static/assets/pfp.jpeg">
                <img class = "discoverimage" src = "static/assets/pfp.jpeg">
                <img class = "discoverimage" src = "static/assets/pfp.jpeg">
            </div>
        </section>

        <section>
            <p>
                <span class = "bold">Events Near You</span>
                <span class = "right">➔</span>
            </p>
            <div class = "flexleft">
                <div class = "grid2"> <!-- due to php includes for the footer, there is clashing css -->
                    <img class = "eventImage discoverimage" src = "static/assets/pfp.jpeg">
                    <div>
                        <span class = "eventName">Event1</span>
                        <span class = "eventcity">Singapore</span>,
                        <span class = "eventState">Singapore</span>
                    </div>

                    <div>
                        <img class = "smallIcons" src = "static/assets/person.png">
                        <span>200 - 500 attendees</span>
                    </div>

                    <div>
                        <img class = "smallIcons" src = "static/assets/ticket.png">
                        <span>$10-$200</span>
                    </div>
                </div>


                <div class = "grid2"> <!-- due to php includes for the footer, there is clashing css -->
                    <img class = "eventImage discoverimage" src = "static/assets/pfp.jpeg">
                    <div>
                        <span class = "eventName">Event1</span>
                        <span class = "eventcity">Singapore</span>
                        <span class = "eventState">Singapore</span>
                    </div>

                    <div>
                        <img class = "smallIcons" src = "static/assets/person.png">
                        <span>200 - 500 attendees</span>
                    </div>

                    <div>
                        <img class = "smallIcons" src = "static/assets/ticket.png">
                        <span>$10-$200</span>
                    </div>
                </div>
            </div>
        </section>


        <section>
            <p>
                <span class = "bold">Events Based on interest</span>
                <span class = "right">➔</span>
            </p>
            <div class = "flexleft">
                <div class = "grid2"> <!-- due to php includes for the footer, there is clashing css -->
                    <img class = "eventImage discoverimage" src = "static/assets/pfp.jpeg">
                    <div>
                        <span class = "eventName">Event1</span>
                        <span class = "eventcity">Singapore</span>,
                        <span class = "eventState">Singapore</span>
                    </div>

                    <div>
                        <img class = "smallIcons" src = "static/assets/person.png">
                        <span>200 - 500 attendees</span>
                    </div>

                    <div>
                        <img class = "smallIcons" src = "static/assets/ticket.png">
                        <span>$10-$200</span>
                    </div>
                </div>
                

                <div class = "grid2"> <!-- due to php includes for the footer, there is clashing css -->
                <img class = "eventImage discoverimage" src = "static/assets/pfp.jpeg">
                    <div>
                        <span class = "eventName">Event1</span>
                        <span class = "eventcity">Singapore</span>,
                        <span class = "eventState">Singapore</span>
                    </div>

                    <div>
                        <img class = "smallIcons" src = "static/assets/person.png">
                        <span>200 - 500 attendees</span>
                    </div>

                    <div>
                        <img class = "smallIcons" src = "static/assets/ticket.png">
                        <span>$10-$200</span>
                    </div>
                </div>
            </div>
        </section>
        <script src = "static/js/home.js"></script>
    </body>
</html>
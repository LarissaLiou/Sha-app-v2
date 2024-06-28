<!DOCTYPE html>
<html>
    <head>
        <title>Profile page</title>
        <link rel = "stylesheet" href = "static/css/profile.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src = "static/js/profile.js"></script>
    </head>

    <body>
        <section id = "followers">
            <div class = "size1">🡰 &nbsp;<span class = "bold">Profile</span><a href = 'backend/logout-end-point.php'><button id = 'logout' href = >Log out</button></a></div>
            <br>

            <div class = "grid1">
                <img id = "pfp" src = "static/assets/pfp.jpeg"> <!-- for backend: to be replaced by an image retrieved from database-->

                <div class = "grid2">
                    <div class = "gridfollowers">
                        <div class = "center bold">99</div>
                        <div class = "center bold">8</div>
                        <div class = "smalltext center">Connections</div>
                        <div class = "smalltext center">Experience</div>
                    </div>

                    <div class = "gridicons">
                        <div id = "followiconbackground">
                            <img id = "followicon" src = "static/assets/followicon.png">
                        </div>
                        <button id = "messagebutton">Message</button>
                    </div>
                </div>
            </div>
        </section>


        <section id = "details" class = "box">
            <div>
                <span id = "personName" class = "bold">Shanice</span> <!-- for backend: replace with name from database-->
                <span id = "personTag" class = "grey">@Shanice1234</span> <!-- for backend: replace with tag from database-->
            </div>

            <div id = "personBackground" class = "grey"><span id = "personOccupation" class = "grey">Student</span> at <span id = "personSchool" class = "grey">River Valley High School</span></div> <!-- for backend: replace with background, occupation, school from database-->
            
            <div id = "personFrom" class = "grey">Founder-in-Residence, YFS 2023</div> <!-- for backend: replace with where the person from from database-->

            <div id = "personOrigin">
                <span id = "personCountry" class = "grey">Singapore</span><span class = "grey">, </span> <!-- for backend: replace with country from database-->
                <span id = "personState" class = "grey">Singapore</span> <!-- for backend: replace with state from database-->
            </div>

        </section>


        <section id = "aboutme" class = "box">
            <div class = "bold titles">About Me</div>
            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                labore et dolore magna aliqua. Ut enim ad minim </div> <!-- for backend: replace with  from database-->
        </section>


        <section id = "interests" class = "box">
            <div id = "interestsTitle" class = "bold titles">Interests</div>
            <!-- not sure how the colours are determined: random, based on category or based on database? So Imma assume it is database for now and put a fixed value-->
            <!-- for backend: replace all interests with database-->
            <span class = "interestBlocks background1 white">Sustainability</span>
            <span class = "interestBlocks background2 white">Sustainability</span>
            <span class = "interestBlocks background3 white">Softball</span>
            <span class = "interestBlocks background4 white">Technology</span>
        </section>

        
        <section id = "highlights" class = "box">
            <div id = "highlightsTitle" class = "bold titles">Highlights</div>
            <div class = "grid3">
                <!-- for backend: replace all highlights with database-->
                <img class = "highlightsImage square" src = "static/assets/pfp.jpeg">
                <img class = "highlightsImage square" src = "static/assets/pfp.jpeg">
                <img class = "highlightsImage square" src = "static/assets/pfp.jpeg">
                <img class = "highlightsImage square" src = "static/assets/pfp.jpeg">
            </div>
        </section>


        <section id = "experience" class = "box">
            <div id = "experienceTitle" class = "bold titles">Experience</div>
            <div class = "grid5">

                <img src = "static/assets/pfp.jpeg" class = "round paddingpls">
                <div class = "grid2 paddingpls">
                    <!-- for backend: replace these details with database-->
                    <div class = "bold">Founder-in-Residence</div>
                    <div class = "grey">Young Founders Summit</div>
                    <div class = "grey">December 2024 - Current</div>
                </div>

                <img src = "static/assets/pfp.jpeg" class = "round paddingpls">
                <div class = "grid2 paddingpls">
                    <div class = "bold">Founder-in-Residence</div>
                    <div class = "grey">Young Founders Summit</div>
                    <div class = "grey">December 2024 - Current</div>
                </div>

                <img src = "static/assets/pfp.jpeg" class = "round paddingpls">
                <div class = "grid2 paddingpls">
                    <div class = "bold">Founder-in-Residence</div>
                    <div class = "grey">Young Founders Summit</div>
                    <div class = "grey">December 2024 - Current</div>
                </div>
            </div>
        </section>

        
        <section id = "contactDetails" class = "box">
            <div id = "contactDetailsTitle" class = "bold titles">Contact Details</div>
            <div id = "contactDetailsBoxes" class = "flex">
                <!-- for backend: replace all contact detail images with backend-->
                <img src = "static/assets/pfp.jpeg" class = "contactDetailsImages square">
                <img src = "static/assets/pfp.jpeg" class = "contactDetailsImages square">
                <img src = "static/assets/pfp.jpeg" class = "contactDetailsImages square">
                <img src = "static/assets/pfp.jpeg" class = "contactDetailsImages square">
                <img src = "static/assets/pfp.jpeg" class = "contactDetailsImages square">
            </div>
        </section>

    </body>
</html>
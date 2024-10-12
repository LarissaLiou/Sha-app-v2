<!DOCTYPE html>
<html>

<head>
    <title>Profile page</title>
    <link rel="stylesheet" href="static/css/profile.css">
    <link rel="stylesheet" href="static/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="static/js/default.js"></script>
    <script src="static/js/profile.js"></script>

</head>

<body>
    <div class="container">
        <section id="followers">
            <a href="index.php?filename=home" id="goBack"><span class="mediumSize">🡰</span></a>&nbsp;&nbsp;&nbsp;
            <h1 class="bold">Profile</h1>
            <a href='index.php?filename=logout' id="logout_button"><button id='logout' href=>Log out</button></a>
    <br>

    <div class="grid1">
        <img id="pfp" src="static/assets/pfpicon.jpg">
        <!-- for backend: to be replaced by an image retrieved from database-->

        <div class="grid2">
            <div class="gridfollowers">
                <div class="center mediumtext bold" id="connection_count">99</div>
                <!-- <div class = "center bold">8</div> -->
                <div class="mediumtext center">Connections</div>
                <!-- <div class = "smalltext center">Experience</div> -->
            </div>

            <div class="gridicons">
                <div id="followiconbackground" onclick="sendConnectionRequest(this)">
                    <img id="followicon" src="static/assets/followicon.png">
                </div>
                <button id="messagebutton" onclick="sendMessageRequest(this)">Message</button>
            </div>
        </div>
    </div>
    </section>


    <section id="details" class="box">
        <div>
            <span id="personName" class="bold">Shanice</span> <!-- for backend: replace with name from database-->
            <span id="personTag" class="grey">@Shanice1234</span> <!-- for backend: replace with tag from database-->
        </div>

        <!-- <div id = "personBackground" class = "grey"><span id = "personOccupation" class = "grey">Student</span> at <span id = "personSchool" class = "grey">River Valley High School</span></div> for backend: replace with background, occupation, school from database -->

        <!-- <div id = "personFrom" class = "grey">Founder-in-Residence, YFS 2023</div> for backend: replace with where the person from from database -->

        <div id="personOrigin">
            <span id="personCountry" class="grey">Singapore</span><span class="grey">, </span>
            <!-- for backend: replace with country from database-->
            <span id="personState" class="grey">Singapore</span> <!-- for backend: replace with state from database-->
        </div>

    </section>


    <section id="aboutme" class="box">
        <div class="bold titles">About Me</div>
        <textarea id="about_input" disabled placeholder="Tell us about yourself..." style = "resize:none;"></textarea>
        <button id="edit_about" class="hidden default_button" onclick="editAbout(this)"
            contenteditable="false">Edit</button>
    </section>


    <section id="interests" class="box">
        <div id="interestsTitle" class="bold titles">Interests</div>
        <!-- not sure how the colours are determined: random, based on category or based on database? So Imma assume it is database for now and put a fixed value-->
        <!-- for backend: replace all interests with database-->
        <div id="interests_container">
        </div>
    </section>
    </div>

</body>

</html>
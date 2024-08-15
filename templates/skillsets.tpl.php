<!DOCTYPE html>
<html>
    <head>
        <title>Interest page2</title>
        <link rel = "stylesheet" href = "static/css/interest.css">
        <link rel = "stylesheet" href = "static/css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src = "static/js/interest2.js"></script>
    </head>

    <body>
        <section>
            <h1>That's great!</h1>
            <p>Moving on, what are some of your skill sets?</p>
        </section>

        <form id = "interestSelection" class = "grid2" action = 'backend/UserSetUp/skillset-end-point.php' method = 'post'>

            <div class = "interestGroup">
                <span class = "interestHeader">Technology</span>
                <div class = "interestCategory grid3">
                    <div class = "category">Machine Learning</div>
                    <div class = "category">Coding</div>
                    <div class = "category">App Development</div>
                    <div class = "category">UI/UX</div>
                    <div class = "category">Web Development</div>
                    <div class = "category">Data Analysis</div>
                </div>
            </div>

            <div class = "interestGroup">
                <span class = "interestHeader">Leadership</span>
                <div class = "interestCategory grid3">
                    <div class = "category">Effective communication</div>
                    <div class = "category">Teamwork</div>
                    <div class = "category">Forward thinking</div>
                    <div class = "category">Management</div>
                    <div class = "category">People-centricity</div>
                    <div class = "category">Adaptable</div>
                </div>
            </div>

            <div class = "interestGroup">
                <span class = "interestHeader">Business management</span>
                <div class = "interestCategory grid3">
                    <div class = "category">Marketing & publicity</div>
                    <div class = "category">Pitching</div>
                    <div class = "category">Operations</div>
                    <div class = "category">Writing</div>
                    <div class = "category">Investment pitchign</div>
                    <div class = "category">Liasons</div>
                </div>
            </div>

            <div class = "interestGroup">
                <span class = "interestHeader">Science and Humainities</span>
                <div class = "interestCategory grid3">
                    <div class = "category">Lab research</div>
                    <div class = "category">Analytical skills</div>
                    <div class = "category">Data management</div>
                    <div class = "category">Report filing</div>
                </div>
            </div>

            <input id = "selectedSkillset" name = "selectedSkillset" value = "[]" hidden>

            <button type = "submit">That's all!</button>
            <button onclick = "removeAll()" type = "submit">I don't really know yet...</button>
            <br>
        </form>
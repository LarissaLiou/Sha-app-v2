<!DOCTYPE html>
<html>
    <head>
        <title>Interest page</title>
        <link rel = "stylesheet" href = "static/css/interest.css">
        <link rel = "stylesheet" href = "static/css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src = "static/js/interest.js"></script>
    </head>

    <body>
        <div class="container">
        <section>
            <h1>Tell us more about yourself!</h1>
            <p>If you were to solve a problem, what would the problem be about?</p>
        </section>

        <form action = "backend/UserSetUp/interest-end-point.php" method = "post" id = "interestSelection">
            <div class = "grid">
                <div class = 'grid-items grid2'>
                    <img src = 'static/assets/climateChange.png' alt = 'Climate Change'>
                    <span class = "text">Climate Change</span>
                </div>

                <div class = 'grid-items grid2'>
                    <img src = 'static/assets/education.png' alt = 'Education'>
                    <span class = "text">Education</span>
                </div>

                <div class = 'grid-items grid2'>
                    <img src = 'static/assets/genderEquality.png' alt = 'Gender Equality'>
                    <span class = "text">Gender Equality</span>
                </div>

                <div class = 'grid-items grid2'>
                    <img src = 'static/assets/technology.png' alt = 'Technology'>
                    <span class = "text">Technology</span>
                </div>

                <div class = 'grid-items grid2'>
                    <img src = 'static/assets/biodiversity.png' alt = 'Biodiversity'>
                    <span class = "text">Biodiversity</span>
                </div>

                <div class = 'grid-items grid2'>
                    <img src = 'static/assets/mentalHealth.png' alt = 'Mental Health'>
                    <span class = "text">Mental Health</span>
                </div>
                
                <div class = 'grid-items grid2'>
                    <img src = 'static/assets/healthcare.png' alt = 'Healthcare'>
                    <span class = "text">Healthcare</span>
                </div>

                <div class = 'grid-items grid2'>
                    <img src = 'static/assets/politics.png' alt = 'Politics'>
                    <span class = "text">Politics</span>
                </div>

                <div class = 'grid-items grid2'>
                    <img src = 'static/assets/warAndMilitaryConflicts.png' alt = 'War and Military Conflicts'>
                    <span class = "text">War and Military Conflicts</span>
                </div>

                <div class = 'grid-items grid2'>
                    <img src = 'static/assets/poverty.png' alt = 'Poverty'>
                    <span class = "text">Poverty</span>
                </div>

                <div class = 'grid-items grid2'>
                    <img src = 'static/assets/inequality.png' alt = 'Inequality'>
                    <span class = "text">Inequality</span>
                </div>

                <div class = 'grid-items grid2'>
                    <img src = 'static/assets/worldHunger.png' alt = 'World Hunger'>
                    <span class = "text">World Hunger</span>
                </div>

                <div class = 'grid-items grid2'>
                    <img src = 'static/assets/artsAndMusic.png' alt = 'Arts and Music'>
                    <span class = "text">Arts and Music</span>
                </div>

                <div class = 'grid-items grid2'>
                    <img src = 'static/assets/sports.png' alt = 'Sports'>
                    <span class = "text">Sports</span>
                </div>
            </div>

            <input id = "selectedInterest" name = "selectedInterest" value = "[]" hidden>

            <button type = "submit">That's all!</button>
            <button onclick = "removeAll()" type = "submit">I don't really know yet...</button>
            <br>
        </form>
        </div>
    </body>
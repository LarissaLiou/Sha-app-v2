<!DOCTYPE html>
<html>
    <head>
        <title>Profile page</title>
        <link rel = "stylesheet" href = "static/css/search.css">
        <link rel = "stylesheet" href = "static/css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src = "static/js/default.js"></script>
    </head>

    <body>
        <div class="container">
        <h1>Find</h1>
        <div id = "searchbar">
            <input type = "text" id = "search" placeholder = "Search Sociate">
            <img id = "searchicon" src = "static/assets/searchicon.svg">
        </div>
        <section id = "recent">
            <!-- <h2>Recent</h2>
            <section id = "recent_profiles">
                
            </section> -->
            <!-- <section id = "recent_searches">

            </section> -->
        </section>
        <section id = "search_result">
            <section id = "profiles_results">
                <h2>Profile Matches</h2>
                <section id = "profiles">
                </section>
            </section>
            <section id = "events_results">
                <h2>Event Matches</h2>
                <section id = "events">
                </section>
            </section>
        </section>
        </div>

        <script src = "static/js/search.js"></script>
    </body>
</html>
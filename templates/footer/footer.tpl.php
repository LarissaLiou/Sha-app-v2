<!DOCTYPE html>
<html>    
    <head>
       <link rel = "stylesheet" href = "static/css/footer.css">
    </head>

    <body>
        <div id = "endingSpace"></div>
        <section id = "bottombar" class = "grid4">
            <a href = "index.php?filename=home">
                <img class = "icons" src = "static/assets/homeicon.png">
            </a>

            <a href = "index.php?filename=connect">
                <img class = "icons" src = "static/assets/peopleicon.png">
            </a>

            <a href = "index.php?filename=search">
            <img class = "icons" src = "static/assets/searchIcon.svg">
            </a>

            <a href = "index.php?filename=profile&user_id=<?= htmlspecialchars($_SESSION['userid'])?>">
                <img class = "icons round" src = "<?= htmlspecialchars($userData['profile_picture'])?>" onerror = "this.src = 'static/assets/default.png'">
            </a>
        </section>
    </body>
</html>
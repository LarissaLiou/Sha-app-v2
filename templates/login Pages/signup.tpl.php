<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="static/css/login.css">
    <link rel="stylesheet" type="text/css" href="static/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src = "login.js" defer>  </script>
</head>
<body>
<?php require "backend/Login/googleLogin.php"?>
    <div class="container">
        <header>
            <h1>Sociate</h1>
        </header>
        <section>
            <h2>Lorem ipsum dolor sit amet, consectetur</h2>
        </section>
        <main>
            <form class = "login_form" action="backend/Login/signup-end-point.php" method="post">
                <input class = "login-button" type="email" id="email" name="email" placeholder="Email" aria-label="Email" required>
                <input class = "login-button" type = "text" id = "username" name = "username" placeholder = "Username" aria-label = "Username" required>
                <input class = "login-button" type="password" id="password" name="password1" placeholder="Password" aria-label="Password" required>
                <input class = "login-button" type="password" id="password" name="password2" placeholder="Confirm Password" aria-label="Confirm Password" required>
                <button class = "login-button login-button--submit" type="submit">Sign up</button>
            </form>
            <div class = "or-divider">or</div>
            <div>
                <p class = "text--small">Sign up with</p>
                <div class = "social-login-buttons">
                <a href = "<?= $googleUrl?>" style = "display:contents"><button class="google"><img src="static/assets/google.png" alt="Google"></button></a>
                </div>
            </div>
        </main>
        
    </div>
    <footer>
        <p class = "text--small">Have an account already? <a class = "signup" href="index.php?filename=login">Login</a></p>
    </footer>

    <script>
        const params = new URLSearchParams(window.location.search);
        const error = params.get('error');
        if (error) {
            alert(error);
        }

    </script>
</body>
</html>

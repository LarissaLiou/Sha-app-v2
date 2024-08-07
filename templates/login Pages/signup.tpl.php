<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../../static/css/login.css">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src = "login.js" defer>  </script>
</head>
<body>
    <div class="container">
        <header>
            <h1>Sociate</h1>
        </header>
        <section>
            <h2>Lorem ipsum dolor sit amet, consectetur</h2>
        </section>
        <main>
            <form class = "login_form" action="backend/signup-end-point.php" method="post">
                <input class = "login-button" type="email" id="email" name="email" placeholder="Username" aria-label="Username" required>
                <input class = "login-button" type="password" id="password" name="password1" placeholder="Password" aria-label="Password" required>
                <input class = "login-button" type="password" id="password" name="password2" placeholder="Confirm Password" aria-label="Confirm Password" required>
                <button class = "login-button login-button--submit" type="submit">Sign up</button>
            </form>
            <div class = "or-divider">or</div>
            <div>
                <p class = "text--small">Sign up with</p>
                <div class = "social-login-buttons">
                    <button class="google"><img src="../../static/assets/google.png" alt="Google"></button>
                    <button class="facebook"><img src="../../static/assets/facebook.png" alt="Facebook"></button>
                    <button class="apple"><img src="../../static/assets/apple.png" alt="Apple"></button>
                </div>
            </div>
        </main>
        
    </div>
    <footer>
        <p class = "text--small">Have an account already? <a class = "signup" href="index.php?filename=login">Login</a></p>
    </footer>

    <?php
        if ($_SESSION['login_attempt'] == false){
            echo "<script>alert('" . $_SESSION['error'] . "');</script>";
            $_SESSION['login_attempt'] = true;
        }
    ?>
</body>
</html>

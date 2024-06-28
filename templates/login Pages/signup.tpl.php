<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" type="text/css" href="style.css">
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
            <form class = "login_form" action="your-login-endpoint" method="post">
                <input class = "login-button" type="email" id="email" name="email" placeholder="Username" aria-label="Username" required>
                <input class = "login-button" type="password" id="password" name="password" placeholder="Password" aria-label="Password" required>
                <input class = "login-button" type="password" id="password" name="password" placeholder="Confirm Password" aria-label="Confirm Password" required>
                <button class = "login-button login-button--submit" type="submit">Sign up</button>
            </form>
            <div class = "or-divider">or</div>
            <div>
                <p class = "text--small">Sign up with</p>
                <div class = "social-login-buttons">
                    <button class="google"><img src="static/google.png" alt="Google"></button>
                    <button class="facebook"><img src="static/facebook.png" alt="Facebook"></button>
                    <button class="apple"><img src="static/apple.png" alt="Apple"></button>
                </div>
            </div>
        </main>
        
    </div>
    <footer>
        <p class = "text--small">Have an account already? <a class = "signup" href="login.html">Login</a></p>
    </footer>
</body>
</html>

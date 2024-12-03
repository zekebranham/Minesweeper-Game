<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: minesweeper.php'); // Redirect to the game if already logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Minesweeper</title>
    <link rel="stylesheet" href="styles/minesweeper.css">
</head>
<body>
    <header>
        <a href="homepage.html">
            <img src="./assets/bulldogs.png" alt="Fresno State Logo" id="logo">
        </a>
        <h1>Login to Minesweeper</h1>
    </header>
    <main>
        <form action="./php/login.php" method="POST" autocomplete="off">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required autocomplete="off">
        
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required autocomplete="off">
        
            <button type="submit">Login</button>
        </form>
        
        <p>Don't have an account? <a href="signup.html">Sign up here</a></p>
    </main>
</body>
</html>

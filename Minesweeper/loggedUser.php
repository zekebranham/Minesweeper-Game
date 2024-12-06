<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: loginPage.php");
    exit();
}

$username = $_SESSION['username']; // Retrieve the username from the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Minesweeper</title>
    <link rel="stylesheet" href="styles/minesweeper.css">
</head>
<body>
    <header>
        <a href="homepage.html">
            <img src="./assets/bulldogs.png" alt="Fresno State Logo" id="logo">
        </a>
        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>You are successfully logged in.</p>
    </header>
    
    <main>
        
        <div id="help-buttons">
            <button onclick="navigateTo('homepage.html')">Return to Homepage</button>
            <button onclick="navigateTo('minesweeper.php')">Start Game</button>
            <button onclick="navigateTo('./php/logout.php')">Sign Out</button> <!-- Sign Out Button -->
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Minesweeper Project | Fresno State</p>
    </footer>

    <script>
        function navigateTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>

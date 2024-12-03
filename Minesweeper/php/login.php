<?php
session_start();
include 'config.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user from database
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        // Authentication successful
        $_SESSION['username'] = $user['username'];
        header('Location: http://10.0.0.45/Minesweeper/Minesweeper/minesweeper.php');
    } else {
        // Authentication failed
        echo 'Invalid username or password';
    }
}
?>

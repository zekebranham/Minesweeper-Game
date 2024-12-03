<?php
session_start();
header('Content-Type: application/json');
include 'config.php'; // Include database connection

if (!isset($_SESSION['username'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit();
}

$username = $_SESSION['username'];

try {
    // Increment the games played count for the user
    $stmt = $conn->prepare("UPDATE users SET games_played = games_played + 1 WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Fetch the updated games played count
    $stmt = $conn->prepare("SELECT games_played FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode(["status" => "success", "games_played" => $result["games_played"]]);
    } else {
        echo json_encode(["status" => "error", "message" => "User not found"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>

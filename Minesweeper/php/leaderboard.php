<?php
session_start();
header('Content-Type: application/json'); // Set the content type to JSON
include 'config.php'; // Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Minesweeper";

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ensure the user is logged in
        if (!isset($_SESSION['username'])) {
            echo json_encode(["status" => "error", "message" => "User not logged in"]);
            exit();
        }

        // Use the logged-in username
        $username = $_SESSION['username'];
        $score = $_POST['score'] ?? 0;
        $mode = $_POST['mode'] ?? 'Beginner';

        if (!empty($mode)) {
            $table = "{$mode}Leaderboard";

            // Insert the new score
            $stmt = $conn->prepare("INSERT INTO $table (username, score) VALUES (:username, :score)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':score', $score);
            $stmt->execute();

            // Return a success response
            echo json_encode(["status" => "success", "message" => "Score added successfully"]);
        } else {
            // Return an error for invalid input
            echo json_encode(["status" => "error", "message" => "Invalid mode data"]);
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Handle leaderboard fetching
        $mode = $_GET['mode'] ?? 'Beginner';
        $table = "{$mode}Leaderboard";

        $stmt = $conn->prepare("SELECT username, score FROM $table ORDER BY score ASC LIMIT 25");
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($results);
    } else {
        // Return an error for invalid request methods
        echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    }
} catch (PDOException $e) {
    // Catch any database errors
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
} catch (Exception $e) {
    // Catch any other errors
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

<?php
require 'config.php'; // Centralized connection
//if you are initializing your own database, please update credidentials in config.php!!!!!!! 

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$dbName = "Minesweeper";

// Check if the database exists
$sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbName'";
$result = $conn->query($sql);

// If the database doesn't exist, create it
if (!($result && $result->num_rows > 0)) {
    $sql = "CREATE DATABASE $dbName";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully.<br>";
    } else {
        die("Error creating database: " . $conn->error);
    }

    $conn->select_db($dbName);

    // Create beginner leaderboard table
    $sql = "CREATE TABLE beginnerleaderboard (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        score decimal(10,2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->query($sql);

    // Create intermediate leaderboard table
    $sql = "CREATE TABLE intermediateleaderboard (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        score decimal(10,2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->query($sql);

    // Create expert leaderboard table
    $sql = "CREATE TABLE expertleaderboard (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        score decimal(10,2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->query($sql);

    // Create users table
    $sql = "CREATE TABLE users (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(50) NOT NULL,
        games_played int(11)
    )";
    $conn->query($sql);

    // Insert sample data into beginner leaderboard
    $sql = "INSERT INTO beginnerleaderboard (username, score) VALUES 
            ('Player1', 1110.00),
            ('Player2', 1115.00),
            ('Player3', 1120.00),
            ('Player4', 1123.00),
            ('Player5', 1123.00),
            ('Player6', 1125.00),
            ('Player7', 1126.00),
            ('Player8', 1127.00),
            ('Player9', 1128.00),
            ('Player10', 1129.00),
            ('Player11', 1130.00),
            ('Player12', 1131.00),
            ('Player13', 1131.00),
            ('Player14', 1133.00),
            ('Player15', 1134.00),
            ('Player16', 1135.00),
            ('Player17', 1136.00),
            ('Player18', 1137.00),
            ('Player19', 1138.00),
            ('Player20', 1139.00),
            ('Player21', 1140.00),
            ('Player22', 1141.00),
            ('Player23', 1142.00),
            ('Player24', 1143.00),
            ('Player25', 1144.00),
            ";
    $conn->query($sql);

    // Insert sample data into intermediate leaderboard
    $sql = "INSERT INTO intermediateleaderboard (username, score) VALUES 
            ('Player1', 1110.00),
            ('Player2', 1115.00),
            ('Player3', 1120.00),
            ('Player4', 1123.00),
            ('Player5', 1123.00),
            ('Player6', 1125.00),
            ('Player7', 1126.00),
            ('Player8', 1127.00),
            ('Player9', 1128.00),
            ('Player10', 1129.00),
            ('Player11', 1130.00),
            ('Player12', 1131.00),
            ('Player13', 1131.00),
            ('Player14', 1133.00),
            ('Player15', 1134.00),
            ('Player16', 1135.00),
            ('Player17', 1136.00),
            ('Player18', 1137.00),
            ('Player19', 1138.00),
            ('Player20', 1139.00),
            ('Player21', 1140.00),
            ('Player22', 1141.00),
            ('Player23', 1142.00),
            ('Player24', 1143.00),
            ('Player25', 1144.00),
            ";
    $conn->query($sql);

    // Insert sample data into expert leaderboard
    $sql = "INSERT INTO expertleaderboard (username, score) VALUES 
            ('Player1', 1110.00),
            ('Player2', 1115.00),
            ('Player3', 1120.00),
            ('Player4', 1123.00),
            ('Player5', 1123.00),
            ('Player6', 1125.00),
            ('Player7', 1126.00),
            ('Player8', 1127.00),
            ('Player9', 1128.00),
            ('Player10', 1129.00),
            ('Player11', 1130.00),
            ('Player12', 1131.00),
            ('Player13', 1131.00),
            ('Player14', 1133.00),
            ('Player15', 1134.00),
            ('Player16', 1135.00),
            ('Player17', 1136.00),
            ('Player18', 1137.00),
            ('Player19', 1138.00),
            ('Player20', 1139.00),
            ('Player21', 1140.00),
            ('Player22', 1141.00),
            ('Player23', 1142.00),
            ('Player24', 1143.00),
            ('Player25', 1144.00),
            ";
    $conn->query($sql);

    // Insert sample data into users table
    $sql = "INSERT INTO users (username, password) VALUES 
            ('Alice', 'password123'),
            ('Bob', 'password123'),
            ('Charlie', 'password123')";
    $conn->query($sql);

    echo "Tables created and sample data inserted successfully.<br>";
} else {
    $conn->select_db($dbName);
    echo "Database already exists. Selected $dbName.<br>";
}

$conn->close();
?>

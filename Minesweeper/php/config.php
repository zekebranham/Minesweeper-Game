<?php
$servername = "localhost";
$username = "root"; // Update as needed
$password = "";     // Update as needed
$dbname = "Minesweeper"; // Update with your database name

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

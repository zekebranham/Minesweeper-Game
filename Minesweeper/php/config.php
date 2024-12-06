<?php
$servername = "localhost"; 
$username = "MarlonBranham"; 
$password = "csci130"; 
$dbname = "Minesweeper"; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

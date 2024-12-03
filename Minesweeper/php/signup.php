<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'config.php'; // Adjust path as necessary

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Validate input
    if (empty($username) || empty($password) || empty($confirmPassword)) {
        header('Location: ../signup.html?status=error&message=All fields are required.');
        exit();
    }

    if ($password !== $confirmPassword) {
        header('Location: ../signup.html?status=error&message=Passwords do not match.');
        exit();
    }

    try {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();

        header('Location: ../signup.html?status=success&message=Signup successful! You can now log in.');
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Duplicate entry error
            header('Location: ../signup.html?status=error&message=Username already exists.');
        } else {
            header('Location: ../signup.html?status=error&message=An unexpected error occurred.');
        }
    }
    exit();
}
?>

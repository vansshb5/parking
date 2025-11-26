<?php

// Database connection
$conn = new mysqli("localhost", "root", "", "parking_system");

// Check connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Get data from form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert query
$sql = "INSERT INTO users (name, email, password, role) 
        VALUES ('$name', '$email', '$hashed_password', '$role')";

if ($conn->query($sql) === TRUE) {
    echo "Signup successful! <a href='login.php'>Login Now</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

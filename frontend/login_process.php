<?php
session_start();

// DB Connect
$conn = new mysqli("localhost", "root", "", "parking_system");

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data
$email = $_POST['email'];
$password = $_POST['password'];

// Check if user exists
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $row['password'])) {
        
        // Set session
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['name'] = $row['name'];

        // Redirect based on role
        if ($row['role'] == "owner") {
            header("Location: owner_dashboard.php");
        } else {
            header("Location: customer_dashboard.php");
        }
        exit();

    } else {
        echo "Invalid password <a href='login.html'>Try again</a>";
    }

} else {
    echo "No user found <a href='signup.html'>Signup here</a>";
}

$conn->close();
?>

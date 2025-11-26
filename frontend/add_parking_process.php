<?php
session_start();

// Only owners allowed
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'owner') {
    echo "Access denied.";
    exit();
}

// DB Connection
$conn = new mysqli("localhost", "root", "", "parking_system");

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Form Data
$owner_id = $_SESSION['user_id'];
$location = $_POST['location'];
$price = $_POST['price'];
$total_slots = $_POST['total_slots'];
$available_slots = $total_slots;   // initially same

// Insert Query
$sql = "INSERT INTO parking_spots (owner_id, location, price_per_hour, total_slots, available_slots)
        VALUES ('$owner_id', '$location', '$price', '$total_slots', '$available_slots')";

if ($conn->query($sql) === TRUE) {
    header("Location: add_parking.php");
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>

<?php
session_start();

// Only customers can book
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    echo "Access denied.";
    exit();
}

// Check form submission
if (!isset($_POST['spot_id']) || !isset($_POST['hours'])) {
    echo "Invalid request.";
    exit();
}

$spot_id = $_POST['spot_id'];
$customer_id = $_SESSION['user_id'];
$hours = $_POST['hours'];

// DB Connect
$conn = new mysqli("localhost", "root", "", "parking_system");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// 1. Check if available slots are still available
$spotCheck = $conn->query("SELECT available_slots FROM parking_spots WHERE spot_id='$spot_id'");
$spotData = $spotCheck->fetch_assoc();

if ($spotData['available_slots'] <= 0) {
    echo "Sorry, no more slots available. <a href='view_parking_customer.php'>Back</a>";
    exit();
}

// 2. Insert booking record
$sql = "INSERT INTO bookings (spot_id, customer_id, hours, status)
        VALUES ('$spot_id', '$customer_id', '$hours', 'booked')";

if ($conn->query($sql) === TRUE) {

    // 3. Reduce available slots by 1
    $conn->query("UPDATE parking_spots SET available_slots = available_slots - 1 WHERE spot_id='$spot_id'");

    echo "Booking successful! <a href='customer_dashboard.php'>Back to Dashboard</a>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>

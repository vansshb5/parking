<?php
session_start();

// Only customers allowed
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    echo "Access denied.";
    exit();
}

// Validate request
if (!isset($_GET['booking_id'])) {
    echo "Invalid request.";
    exit();
}

$booking_id = $_GET['booking_id'];

$conn = new mysqli("localhost", "root", "", "parking_system");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Get booking details
$b = $conn->query("SELECT spot_id FROM bookings WHERE booking_id='$booking_id' AND status='booked'");
if ($b->num_rows == 0) {
    echo "Booking not found or already cancelled.";
    exit();
}
$data = $b->fetch_assoc();
$spot_id = $data['spot_id'];

// 1. Update status to cancelled
$conn->query("UPDATE bookings SET status='cancelled' WHERE booking_id='$booking_id'");

// 2. Increase available slots back by 1
$conn->query("UPDATE parking_spots SET available_slots = available_slots + 1 WHERE spot_id='$spot_id'");

header("Location: book_parking.php");

$conn->close();
?>

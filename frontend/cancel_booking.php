<?php
// cancel_booking.php
ini_set('display_errors', 1);
error_reporting(E_ALL);
define('DEBUG', true); // set to false after debugging

session_start();

function dbg($msg) {
    file_put_contents(__DIR__ . '/debug_cancel.log', date('Y-m-d H:i:s') . " - " . $msg . PHP_EOL, FILE_APPEND);
}

dbg("==== cancel request ====");
dbg("REQUEST_METHOD: " . $_SERVER['REQUEST_METHOD']);
dbg("GET: " . json_encode($_GET));
dbg("POST: " . json_encode($_POST));
dbg("SESSION: " . json_encode($_SESSION));

// 1) Basic session check
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    dbg("Access denied: role missing or not customer");
    if (DEBUG) { echo "Access denied (not customer)."; }
    exit();
}

// 2) Ensure booking_id provided
if (!isset($_GET['booking_id']) || empty($_GET['booking_id'])) {
    dbg("Missing booking_id in GET");
    if (DEBUG) {
        echo "Invalid request: booking_id missing.<br>";
        echo "<pre>GET:\n"; print_r($_GET); echo "</pre>";
    } else {
        echo "Invalid request.";
    }
    exit();
}

$booking_id = $_GET['booking_id'];
$customer_id = $_SESSION['user_id'] ?? null;
if (!$customer_id) {
    dbg("Missing user_id in session");
    if (DEBUG) { echo "Invalid session (user_id missing)."; }
    exit();
}

// DB connect
$mysqli = new mysqli("localhost", "root", "", "parking_system");
if ($mysqli->connect_error) {
    dbg("DB connect error: " . $mysqli->connect_error);
    die("Connection Failed: " . $mysqli->connect_error);
}

$mysqli->begin_transaction();

try {
    // Verify booking belongs to this customer and is currently 'booked'
    $stmt = $mysqli->prepare("SELECT spot_id, status FROM bookings WHERE booking_id = ? AND customer_id = ?");
    $stmt->bind_param('ii', $booking_id, $customer_id);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 0) {
        dbg("Booking not found or does not belong to user. booking_id=$booking_id, customer_id=$customer_id");
        throw new Exception("Booking not found or not allowed.");
    }

    $row = $res->fetch_assoc();
    if ($row['status'] !== 'booked') {
        dbg("Booking already not in booked state. booking_id=$booking_id status=" . $row['status']);
        throw new Exception("Booking is not active (already cancelled or completed).");
    }

    $spot_id = $row['spot_id'];

    // Mark booking cancelled
    $stmt = $mysqli->prepare("UPDATE bookings SET status = 'cancelled' WHERE booking_id = ?");
    $stmt->bind_param('i', $booking_id);
    if (!$stmt->execute()) {
        dbg("Failed to update bookings: " . $stmt->error);
        throw new Exception("Unable to cancel booking.");
    }

    // Increase available slots
    $stmt = $mysqli->prepare("UPDATE parking_spots SET available_slots = available_slots + 1 WHERE spot_id = ?");
    $stmt->bind_param('s', $spot_id);
    if (!$stmt->execute()) {
        dbg("Failed to update parking_spots: " . $stmt->error);
        throw new Exception("Unable to update parking spots.");
    }

    $mysqli->commit();
    dbg("Cancel successful for booking_id=$booking_id, spot_id=$spot_id");

    // Redirect back to bookings page
    if (DEBUG) {
        header("Location: view_bookings_customer.php");
    } else {
        header("Location: book_parking.php?cancelled=1");
    }
    exit();

} catch (Exception $e) {
    $mysqli->rollback();
    dbg("Cancel transaction failed: " . $e->getMessage());
    if (DEBUG) {
        echo "Error: " . htmlspecialchars($e->getMessage());
        echo "<pre>See debug_cancel.log for details.</pre>";
    } else {
        echo "Error cancelling booking.";
    }
    exit();
}
?>

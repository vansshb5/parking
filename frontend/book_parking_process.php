<?php
// book_parking_process.php (drop-in debug version)
ini_set('display_errors', 1);
error_reporting(E_ALL);

define('DEBUG', true); // set false later when fixed

session_start();

// Debug logger helper
function dbg($msg) {
    file_put_contents(__DIR__ . '/debug.log', date('Y-m-d H:i:s') . " - " . $msg . PHP_EOL, FILE_APPEND);
}

// Log initial state
dbg("==== new request ====");
dbg("REQUEST_METHOD: " . $_SERVER['REQUEST_METHOD']);
dbg("POST: " . json_encode($_POST));
dbg("GET: " . json_encode($_GET));
dbg("SESSION: " . json_encode($_SESSION));

// Basic access check
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    dbg("Access denied: role missing or not customer");
    if (DEBUG) { echo "Access denied (session role).<br>"; }
    exit();
}

// Check form submission
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    dbg("Not a POST request");
    if (DEBUG) { echo "Invalid request: not POST.<br>"; }
    exit();
}

if (!isset($_POST['spot_id']) || !isset($_POST['hours'])) {
    dbg("Missing POST fields. spot_id present? " . (isset($_POST['spot_id']) ? 'yes' : 'no') . " hours present? " . (isset($_POST['hours']) ? 'yes' : 'no'));
    if (DEBUG) {
        echo "<pre>Invalid request: missing fields.\n\nPOST:\n";
        print_r($_POST);
        echo "\nSESSION:\n";
        print_r($_SESSION);
        echo "</pre>";
    } else {
        echo "Invalid request.";
    }
    exit();
}

$spot_id = $_POST['spot_id'];
$customer_id = $_SESSION['user_id'] ?? null;
$hours = intval($_POST['hours']);

// extra checks
if (!$customer_id) {
    dbg("Missing user_id in session");
    if (DEBUG) { echo "Session missing user_id.<br>"; }
    exit();
}

if ($hours <= 0) {
    dbg("Invalid hours: $hours");
    if (DEBUG) { echo "Invalid hours value.<br>"; }
    exit();
}

// DB Connect
$mysqli = new mysqli("localhost", "root", "", "parking_system");
if ($mysqli->connect_error) {
    dbg("DB connect error: " . $mysqli->connect_error);
    die("Connection Failed: " . $mysqli->connect_error);
}

// Start transaction to prevent race conditions
$mysqli->begin_transaction();

try {
    // 1) Check available slots using SELECT ... FOR UPDATE
    $stmt = $mysqli->prepare("SELECT available_slots FROM parking_spots WHERE spot_id = ? FOR UPDATE");
    $stmt->bind_param('s', $spot_id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows === 0) {
        dbg("Spot not found: $spot_id");
        throw new Exception("Parking spot not found.");
    }
    $row = $res->fetch_assoc();
    $available = intval($row['available_slots']);
    dbg("Spot $spot_id available_slots = $available");

    if ($available <= 0) {
        throw new Exception("Sorry, no more slots available.");
    }

    // 2) Insert booking (prepared)
    $stmt = $mysqli->prepare("INSERT INTO bookings (spot_id, customer_id, hours, status) VALUES (?, ?, ?, 'booked')");
    $stmt->bind_param('sis', $spot_id, $customer_id, $hours);
    if (!$stmt->execute()) {
        dbg("Insert booking failed: " . $stmt->error);
        throw new Exception("Unable to create booking.");
    }
    dbg("Booking inserted, id = " . $mysqli->insert_id);

    // 3) Reduce available slots
    $stmt = $mysqli->prepare("UPDATE parking_spots SET available_slots = available_slots - 1 WHERE spot_id = ?");
    $stmt->bind_param('s', $spot_id);
    if (!$stmt->execute()) {
        dbg("Update slots failed: " . $stmt->error);
        throw new Exception("Unable to update parking slot availability.");
    }
    dbg("available_slots decremented for spot $spot_id");

    $mysqli->commit();

    // success -> redirect (use exit after header)
    if (DEBUG) {
        header("Location: view_bookings_customer.php");
    } else {
        header("Location: book_parking.php?success=1");
    }
    exit();

} catch (Exception $e) {
    $mysqli->rollback();
    dbg("Transaction failed: " . $e->getMessage());
    if (DEBUG) {
        echo "Error: " . htmlspecialchars($e->getMessage());
        echo "<pre>See debug.log in project folder for details.</pre>";
    } else {
        echo "Error: " . $e->getMessage();
    }
    exit();
}
?>

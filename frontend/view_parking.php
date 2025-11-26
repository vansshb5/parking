<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'owner') {
    echo "Access denied.";
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo "Please login first.";
    exit;
}

$conn = new mysqli("localhost", "root", "", "parking_system");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$owner_id = $_SESSION['user_id'];

$sql = "SELECT p.*, 
        (SELECT COUNT(*) FROM bookings 
         WHERE bookings.spot_id = p.spot_id 
         AND bookings.status = 'booked') AS booked_slots
        FROM parking_spots p
        WHERE p.owner_id = '$owner_id'";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Parking Spots</title>
</head>
<body>
<h2>Your Parking Spots</h2>

<table border="1" cellpadding="6">
    <tr>
        <th>Spot ID</th>
        <th>Location</th>
        <th>Price/hr</th>
        <th>Total Slots</th>
        <th>Booked</th>
        <th>Available</th>
    </tr>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $available = $row['total_slots'] - $row['booked_slots'];
        echo "<tr>
                <td>".$row['spot_id']."</td>
                <td>".$row['location']."</td>
                <td>".$row['price_per_hour']."</td>
                <td>".$row['total_slots']."</td>
                <td>".$row['booked_slots']."</td>
                <td>".$available."</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No parking spots added yet.</td></tr>";
}
?>
</table>
</body>
</html>

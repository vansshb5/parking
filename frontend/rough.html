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

$owner_id = $_SESSION['user_id'];

$sql = "SELECT * FROM parking_spots WHERE owner_id = '$owner_id'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Parking Spots</title>
</head>
<body>

<h2>Your Parking Spots</h2>
<a href="owner_dashboard.php">Back to Dashboard</a><br><br>

<table border="1" cellpadding="6">
    <tr>
        <th>Spot ID</th>
        <th>Location</th>
        <th>Price/hr</th>
        <th>Total Slots</th>
        <th>Available</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['spot_id']."</td>
                    <td>".$row['location']."</td>
                    <td>".$row['price_per_hour']."</td>
                    <td>".$row['total_slots']."</td>
                    <td>".$row['available_slots']."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No parking spots added yet.</td></tr>";
    }
    ?>
</table>

</body>
</html>

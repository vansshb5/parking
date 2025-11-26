<?php
session_start();

// Only customers allowed
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    echo "Access denied. Only customers can book parking.";
    exit();
}

// DB Connection
$conn = new mysqli("localhost", "root", "", "parking_system");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Default query (no search)
$sql = "SELECT * FROM parking_spots WHERE available_slots > 0";

// If search submitted
if (isset($_POST['search'])) {
    $location = $_POST['location'];
    $sql = "SELECT * FROM parking_spots 
            WHERE location LIKE '%$location%' AND available_slots > 0";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Parking Spots</title>
</head>
<body>

<h2>Available Parking Spots</h2>
<a href="customer_dashboard.php">Back to Dashboard</a>
<br><br>

<!-- Search Form -->
<form method="POST" action="">
    <label>Search by Location:</label><br>
    <input type="text" name="location" placeholder="Enter area name">
    <button type="submit" name="search">Search</button>
</form>

<br>

<table border="1" cellpadding="6">
    <tr>
        <th>Spot ID</th>
        <th>Location</th>
        <th>Price/hr</th>
        <th>Available Slots</th>
        <th>Action</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['spot_id']."</td>
                    <td>".$row['location']."</td>
                    <td>".$row['price_per_hour']."</td>
                    <td>".$row['available_slots']."</td>
                    <td><a href='book_parking.php?spot_id=".$row['spot_id']."'>Book</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No parking spots found</td></tr>";
    }
    ?>
</table>

</body>
</html>

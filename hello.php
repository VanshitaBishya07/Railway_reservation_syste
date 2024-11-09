<?php
session_start();
require('firstimport.php');

// Check if the user is logged in
if(!isset($_SESSION['name'])) {
    header("location:login1.php");
    exit; // Stop further execution
}

$tbl_name = "booking";
$uname = $_SESSION['name'];

// Connect to the database
$conn = mysqli_connect($servername, $username, $password, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user bookings from the database
$sql = "SELECT * FROM $tbl_name WHERE uname='$uname'";
$result = mysqli_query($conn, $sql);

// Check if there are any bookings
if (mysqli_num_rows($result) > 0) {
    // Start displaying booking data
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Bookings</title>
        <style>
            /* Add your CSS styles here */
        </style>
    </head>
    <body>
        <h1>My Bookings</h1>
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Train Number</th>
                    <th>Class</th>
                    <th>Date of Journey</th>
                    <!-- Add more table headers as needed -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through each booking and display it in a table row
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['booking_id']; ?></td>
                        <td><?php echo $row['Tnumber']; ?></td>
                        <td><?php echo $row['class']; ?></td>
                        <td><?php echo $row['doj']; ?></td>
                        <!-- Add more table cells as needed -->
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </body>
    </html>
    <?php
} else {
    // If no bookings found
    echo "<p>No bookings found.</p>";
}

// Close the database connection
mysqli_close($conn);
?>

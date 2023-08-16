<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <!-- Add your CSS file(s) here -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- View bookings section -->
    <div class="view-bookings">
        <?php
        // Include the configuration file and any other necessary files
        require_once 'config.php';
        // You may include other files here if needed, e.g., functions, database connection, etc.
        require_once 'db.php';
        // Fetch all bookings from the database
        $query = "SELECT * FROM bookings";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful and if there are any bookings
        if ($result && mysqli_num_rows($result) > 0) {
            ?>
            <h2>All Bookings</h2>
            <table>
                <tr>
                    <th>Booking ID</th>
                    <th>Hall Name</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <!-- Add more columns as needed -->
                </tr>
                <?php
                // Loop through each booking and display the details in the table
                while ($booking = mysqli_fetch_assoc($result)) {
                    // Fetch hall details for the current booking
                    $hall_id = $booking['hall_id'];
                    $hall_query = "SELECT name FROM halls WHERE id = $hall_id";
                    $hall_result = mysqli_query($conn, $hall_query);
                    $hall_name = ($hall_result && mysqli_num_rows($hall_result) > 0) ? mysqli_fetch_assoc($hall_result)['name'] : 'Unknown Hall';

                    // Display the booking details
                    ?>
                    <tr>
                        <td><?php echo $booking['id']; ?></td>
                        <td><?php echo $hall_name; ?></td>
                        <td><?php echo $booking['event_date']; ?></td>
                        <td><?php echo $booking['event_time']; ?></td>
                        <!-- Add more columns as needed -->
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        } else {
            // If there are no bookings, display a message
            echo "<p>No bookings found.</p>";
        }

        // Free the result set
        mysqli_free_result($result);

        // Close the database connection (assuming you're using MySQL)
        mysqli_close($conn);
        ?>
    </div>

    <!-- Add your JavaScript file(s) here if needed -->
    <script src="js/script.js"></script>
</body>

</html>

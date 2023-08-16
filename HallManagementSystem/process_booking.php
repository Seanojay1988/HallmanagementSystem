<?php
// Include the configuration file and any other necessary files
require_once 'config.php';
// You may include other files here if needed, e.g., functions, database connection, etc.
require 'db.php';
// Initialize variables to store status and error messages
$status = "";
$errorMsg = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate the input fields (you may add more validation as needed)
    $hallId = (int)$_POST['hall_id'];
    $eventDate = mysqli_real_escape_string($conn, $_POST['event_date']);
    $eventTime = mysqli_real_escape_string($conn, $_POST['event_time']);

    // Perform validation, e.g., checking if the hall is available on the selected date and time
    // ...

    // Insert the booking data into the database
    $insertQuery = "INSERT INTO bookings (hall_id, event_date, event_time) VALUES ($hallId, '$eventDate', '$eventTime')";
    $result = mysqli_query($conn, $insertQuery);

    if ($result) {
        // If the booking is successful, display a success message
        $status = "Booking successful!";
    } else {
        // If there was an error during the booking process, display an error message
        $errorMsg = "Error processing the booking. Please try again.";
    }
}

// Close the database connection (assuming you're using MySQL)
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Status</title>
    <!-- Add your CSS file(s) here -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Display booking status or error message -->
    <div class="booking-status">
        <?php if ($status !== "") : ?>
            <h2>Booking Status</h2>
            <p class="success"><?php echo $status; ?></p>
        <?php elseif ($errorMsg !== "") : ?>
            <h2>Error</h2>
            <p class="error"><?php echo $errorMsg; ?></p>
        <?php endif; ?>
        <!-- Add a link to go back to the previous page or home page -->
        <p><a href="index.php">Go back to Home</a></p>
    </div>

    <!-- Add your JavaScript file(s) here if needed -->
    <script src="js/script.js"></script>
</body>

</html>

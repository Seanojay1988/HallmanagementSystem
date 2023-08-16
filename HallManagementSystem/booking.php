<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Booking</title>
    <!-- Add your CSS file(s) here -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Booking form section -->
    <div class="booking-form">
        <?php
        // Include the configuration file and any other necessary files
        require_once 'config.php';
        // You may include other files here if needed, e.g., functions, database connection, etc.
        require_once 'db.php';

        // Check if the hall ID is provided in the URL parameter
        if (isset($_GET['hall_id']) && !empty($_GET['hall_id'])) {
            // Sanitize the hall ID to prevent SQL injection (assuming you're using MySQL)
            $hall_id = mysqli_real_escape_string($conn, $_GET['hall_id']);

            // Fetch hall details from the database to check availability
            $query = "SELECT * FROM halls WHERE id = $hall_id";
            $result = mysqli_query($conn, $query);

            // Check if the query was successful and if a hall was found
            if ($result && mysqli_num_rows($result) > 0) {
                // Fetch hall details as an associative array
                $hall = mysqli_fetch_assoc($result);
                ?>
                <h2>Booking for <?php echo $hall['name']; ?></h2>
                <!-- Your booking form code goes here -->
                <form action="process_booking.php" method="post">
                    <input type="hidden" name="hall_id" value="<?php echo $hall_id; ?>">
                    <!-- Add booking form fields, such as event date, time, user details, etc. -->
                    <div class="form-group">
                        <label for="event_date">Event Date:</label>
                        <input type="date" id="event_date" name="event_date" required>
                    </div>

                    <div class="form-group">
                        <label for="event_time">Event Time:</label>
                        <input type="time" id="event_time" name="event_time" required>
                    </div>

                    <!-- Add more booking form fields as needed -->

                    <button type="submit">Book Now</button>
                </form>
                <?php
            } else {
                // If the hall is not found, display an error message
                echo "<p>Hall not found.</p>";
            }

            // Free the result set
            mysqli_free_result($result);
        } else {
            // If no hall ID is provided in the URL parameter, display an error message
            echo "<p>Invalid hall ID.</p>";
        }

        // Close the database connection (assuming you're using MySQL)
        mysqli_close($conn);
        ?>
    </div>

    <!-- Add your JavaScript file(s) here if needed -->
    <script src="js/script.js"></script>
</body>

</html>

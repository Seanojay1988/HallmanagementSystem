<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Details</title>
    <!-- Add your CSS file(s) here -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Hall details section -->
    <div class="hall-details">
        <?php
        // Include the configuration file and any other necessary files
        require_once 'config.php';
        // You may include other files here if needed, e.g., functions, database connection, etc.

        // Check if the hall ID is provided in the URL parameter
        if (isset($_GET['hall_id']) && !empty($_GET['hall_id'])) {
            // Sanitize the hall ID to prevent SQL injection (assuming you're using MySQL)
            $hall_id = mysqli_real_escape_string($connection, $_GET['hall_id']);

            // Fetch hall details from the database
            $query = "SELECT * FROM halls WHERE id = $hall_id";
            $result = mysqli_query($connection, $query);

            // Check if the query was successful and if a hall was found
            if ($result && mysqli_num_rows($result) > 0) {
                // Fetch hall details as an associative array
                $hall = mysqli_fetch_assoc($result);
                ?>
                <h2><?php echo $hall['name']; ?></h2>
                <p>Capacity: <?php echo $hall['capacity']; ?></p>
                <p>Facilities: <?php echo $hall['facilities']; ?></p>
                <!-- Add more hall details as needed -->
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
        mysqli_close($connection);
        ?>
    </div>

    <!-- Add your JavaScript file(s) here if needed -->
    <script src="js/script.js"></script>
</body>

</html>

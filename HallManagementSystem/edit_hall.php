<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hall</title>
    <!-- Add your CSS file(s) here -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Edit hall form section -->
    <div class="edit-hall-form">
        <?php
        // Include the configuration file and any other necessary files
        require_once 'config.php';
        // You may include other files here if needed, e.g., functions, database connection, etc.

        // Check if the hall ID is provided in the URL parameter
        if (isset($_GET['hall_id']) && !empty($_GET['hall_id'])) {
            // Sanitize the hall ID to prevent SQL injection (assuming you're using MySQL)
            $hall_id = mysqli_real_escape_string($connection, $_GET['hall_id']);

            // Check if the form is submitted for updating the hall information
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Sanitize and validate the input fields (you may add more validation as needed)
                $name = mysqli_real_escape_string($connection, $_POST['name']);
                $capacity = (int)$_POST['capacity'];
                $facilities = mysqli_real_escape_string($connection, $_POST['facilities']);

                // Perform validation, e.g., checking if the capacity is a positive number, etc.
                // ...

                // Update the hall data in the database
                $updateQuery = "UPDATE halls SET name = '$name', capacity = $capacity, facilities = '$facilities' WHERE id = $hall_id";
                $result = mysqli_query($connection, $updateQuery);

                if ($result) {
                    // If the hall is updated successfully, display a success message
                    echo "<p>Hall updated successfully!</p>";
                } else {
                    // If there was an error updating the hall, display an error message
                    echo "<p>Error updating hall. Please try again.</p>";
                }
            }

            // Fetch hall details from the database to prepopulate the form fields
            $query = "SELECT * FROM halls WHERE id = $hall_id";
            $result = mysqli_query($connection, $query);

            // Check if the query was successful and if a hall was found
            if ($result && mysqli_num_rows($result) > 0) {
                // Fetch hall details as an associative array
                $hall = mysqli_fetch_assoc($result);
                ?>
                <!-- Hall form -->
                <h2>Edit Hall: <?php echo $hall['name']; ?></h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?hall_id=' . $hall_id; ?>" method="post">
                    <div class="form-group">
                        <label for="name">Hall Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo $hall['name']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="capacity">Capacity:</label>
                        <input type="number" id="capacity" name="capacity" value="<?php echo $hall['capacity']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="facilities">Facilities:</label>
                        <textarea id="facilities" name="facilities" required><?php echo $hall['facilities']; ?></textarea>
                    </div>

                    <button type="submit">Update Hall</button>
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
        mysqli_close($connection);
        ?>
    </div>

    <!-- Add your JavaScript file(s) here if needed -->
    <script src="js/script.js"></script>
</body>

</html>

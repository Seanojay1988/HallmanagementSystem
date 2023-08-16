<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Hall</title>
    <!-- Add your CSS file(s) here -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Add hall form section -->
    <div class="add-hall-form">
        <?php
        // Include the configuration file and any other necessary files
        require_once 'config.php';
        // You may include other files here if needed, e.g., functions, database connection, etc.
        require_once "db.php";

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize and validate the input fields (you may add more validation as needed)
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $capacity = (int)$_POST['capacity'];
            $facilities = mysqli_real_escape_string($conn, $_POST['facilities']);

            // Perform validation, e.g., checking if the capacity is a positive number, etc.
            // ...

            // Insert the hall data into the database
            $insertQuery = "INSERT INTO halls (name, capacity, facilities) VALUES ('$name', $capacity, '$facilities')";
            $result = mysqli_query($conn, $insertQuery);

            if ($result) {
                // If the hall is added successfully, display a success message
                echo "<p>Hall added successfully!</p>";
            } else {
                // If there was an error adding the hall, display an error message
                echo "<p>Error adding hall. Please try again.</p>";
            }
        }
        ?>
        <!-- Hall form -->
        <h2>Add a New Hall</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                <label for="name">Hall Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="capacity">Capacity:</label>
                <input type="number" id="capacity" name="capacity" required>
            </div>

            <div class="form-group">
                <label for="facilities">Facilities:</label>
                <textarea id="facilities" name="facilities" required></textarea>
            </div>

            <button type="submit">Add Hall</button>
        </form>
    </div>

    <!-- Add your JavaScript file(s) here if needed -->
    <script src="js/script.js"></script>
</body>

</html>

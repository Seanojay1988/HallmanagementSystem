<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Add your CSS file(s) here -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- User registration form section -->
    <div class="registration-form">
        <?php
        // Include the configuration file and any other necessary files
        require_once 'config.php';
        // You may include other files here if needed, e.g., functions, database connection, etc.
        require 'db.php';
        include "header.php";
        // Initialize variables to store status and error messages
        $status = "";
        $errorMsg = "";

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize and validate the input fields (you may add more validation as needed)
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            // Perform validation, e.g., checking if the username and email are not empty, if the email is valid, etc.
            // ...

            // Hash the password before storing it in the database
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert the new user data into the database
            $insertQuery = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
            $result = mysqli_query($conn, $insertQuery);

            if ($result) {
                // If the user is registered successfully, display a success message
                $status = "User registered successfully!";
            } else {
                // If there was an error registering the user, display an error message
                $errorMsg = "Error registering user. Please try again.";
            }
        }
        ?>
        <!-- Registration form -->
        
        <div class="container">
            <h2>User Registration</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username"  required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email"  name="email"  required>
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="password"  name="password"  required>
                </div>
                <div class="form-group form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="remember"> Remember me
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div

        

       <!-- Display status or error message  -->
        <?php if ($status !== "") : ?>
            <p class="success"><?php echo $status; ?></p>
        <?php elseif ($errorMsg !== "") : ?>
            <p class="error"><?php echo $errorMsg; ?></p>
        <?php endif; ?>
    </div>

    <!-- Add your JavaScript file(s) here if needed -->
    <script src="js/script.js"></script>
</body>

</html>
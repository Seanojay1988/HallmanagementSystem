

<body>
    

<?php include "header.php" ?>

        <!-- Add your logo or site title here -->
       
        <!-- Add a user login/logout link if needed -->
        <span><a href="user_login.php">Login</a></span>
        <span><a href="register.php">Sign Up</a></span>
        <!-- For example:
        <div class="user-info">
            <span>Welcome, John Doe</span>
            <a href="logout.php">Logout</a>
        </div>
        -->
    </header>

    <!-- Main content area -->
    <main>
        <?php
        // Include the configuration file and any other necessary files
        require_once 'config.php';
        // Start a session (if needed for user authentication or other purposes)
        session_start();

        // Handle incoming requests and routing based on query parameters or URL paths
        if (isset($_GET['page'])) {
            // Determine the requested page
            $requestedPage = $_GET['page'];

            // Use a switch statement to handle different pages/routes
            switch ($requestedPage) {
                case 'home':
                    // Include home.php for the home page content
                    require 'home.php';
                    break;

                case 'booking':
                    // Include booking.php to handle hall bookings and availability
                    require 'booking.php';
                    break;

                case 'view_bookings':
                    // Include view_bookings.php to display all the bookings for different halls
                    require 'view_bookings.php';
                    break;

                    // Add more cases for other pages as needed
                case 'add_hall':
                    require 'add_hall.php';
                    break;
                default:
                    // If the requested page doesn't match any known routes, display a 404 page or redirect to the home page.
                    header("HTTP/1.0 404 Not Found");
                    echo "Page not found.";
                    break;
            }
        } else {
            // If no specific page is requested, display the default home page or any other landing page.
            require 'home.php';
        }
        ?>
    </main>

    <!-- Footer section -->
    <?php include "footer.php" ?>

    <!-- Add your JavaScript file(s) here if needed -->
    <script src="js/script.js"></script>
</body>

</html>
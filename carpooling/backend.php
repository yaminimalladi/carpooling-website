<?php

// Set up file paths
$usersFile = 'users.json';
$ridesFile = 'rides.json';

// Check if users file exists
if (!file_exists($usersFile)) {
    // Create empty array
    $usersData = [];
} else {
    // Load existing data
    $usersData = json_decode(file_get_contents($usersFile), true);
}

// Check if rides file exists
if (!file_exists($ridesFile)) {
    // Create empty array
    $ridesData = [];
} else {
    // Load existing data
    $ridesData = json_decode(file_get_contents($ridesFile), true);
}

// Check which route was requested
$route = $_GET['route'];
if ($route == 'login') {
    // Handle login form submission
if ($route == 'login') {
    // Check if email and password were provided
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if both email and password are not empty
        if (!empty($email) && !empty($password)) {
            // Check if user exists
            if (isset($usersData[$email]) && $usersData[$email]['password'] == $password) {
                // Successful login
                echo 'Login successful! Welcome.';

                // Redirect to rides.html
                header('Location: rides.html');
                exit;
            } else {
                // Invalid login
                echo 'Ooops no! Invalid email or password.';
            }
        } else {
            // Email and/or password not provided
            echo 'Ooops no! Please provide email and password.';
        }
    } else {
        // Email and/or password not provided
        echo 'Ooops no! Please provide email and password.';
    }
}

} elseif ($route == 'users') {
    // Handle user sign up form submission

    // Check if required fields were provided
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['phone'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];

        // Check if user already exists
        if (isset($usersData[$email])) {
            // User already exists
            echo 'Ooops no! User with this email already exists.';
        } else {
            // Add new user to data array
            $usersData[$email] = [
                'name' => $name,
                'password' => $password,
                'phone' => $phone
            ];

            // Save updated data to file
            file_put_contents($usersFile, json_encode($usersData));

            // Successful sign up
            echo 'Sign up successful.';

            // Redirect to rides.html
            header('Location: rides.html');
            exit;
        }
    } else {
        // Required fields not provided
        echo 'Ooops no! Please provide all required fields.';
    }
} elseif ($route == 'rides') {
    // Check if user is logged in
    session_start();
    if (!isset($_SESSION['email'])) {
        echo 'Ooops no! Please log in to create a ride.';
        exit;
    }

    // Handle new ride form submission
    // Check if required fields were provided
    if (isset($_POST['origin']) && isset($_POST['destination']) && isset($_POST['date']) && isset($_POST['seats']) && isset($_POST['driver_id'])) {
        $origin = $_POST['origin'];
        $destination = $_POST['destination'];
        $date = $_POST['date'];
        $seats = $_POST['seats'];
        $driverId = $_POST['driver_id'];

        // Add new ride to data array
        $ridesData[]= [
            'origin' => $origin,
            'destination' => $destination,
            'date' => $date,
            'seats' => $seats,
            'driver_id' => $driverId,
            'passengers' => []
        ];

        // Save updated data to file
        file_put_contents($ridesFile, json_encode($ridesData));

        // Successful ride creation
        echo 'Ride created successfully.';

    } else {
        // Required fields not provided
        echo 'Ooops no! Please provide all required fields.';
    }

} else {
    // Invalid route requested
    echo 'Invalid route requested.';
} 


?>


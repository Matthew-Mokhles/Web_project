<?php
session_start();  // Start the session at the beginning

// Define the test_input function
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Initialize variables for form input
$username = $password = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty($_POST["username"])) {
        $_SESSION['error'] = "Username is required";
        header("Location: login.php");
        exit;
    } else {
        $username = test_input($_POST["username"]);
    }

    // Validate password
    if (empty($_POST["password"])) {
        $_SESSION['error'] = "Password is required";
        header("Location: login.php");
        exit;
    } else {
        $password = test_input($_POST["password"]);
    }

    // If there are no errors, proceed with login
    if (empty($_SESSION['error'])) {
        // Database connection
        $servername = "localhost"; 
        $db_username = "root"; 
        $db_password = "1234"; 
        $dbname = "bookstore"; 

        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        if (!$stmt) {
            $_SESSION['error'] = "Database error: " . $conn->error;
            header("Location: login.php");
            exit;
        }
        
        $stmt->bind_param("s", $username);

        // Execute the statement
        $stmt->execute();

        // Store the result
        $stmt->store_result();

        // Check if the user exists, if yes then verify password
        if ($stmt->num_rows == 1) {
            // Bind result variables
            $stmt->bind_result($hashed_password);
            if ($stmt->fetch()) {
                if (password_verify($password, $hashed_password)) {
                    // Set session variables
                    $_SESSION['username'] = $username;

                    // Debug statement
                    error_log("Login successful for user: $username");

                    // Redirect to index page on successful login
                    header("Location: index.php");
                    exit;
                } else {
                    $_SESSION['error'] = "Invalid username or password";
                }
            }
        } else {
            $_SESSION['error'] = "Invalid username or password";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
    
    // Redirect back to login page if there are errors
    header("Location: login.php");
    exit;
}

<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "bookstore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $email = $password = "";
$usernameErr = $emailErr = $passwordErr = "";
$isValid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
        $isValid = false;
    } else {
        $username = test_input($_POST["username"]);
        if (strlen($username) < 5 || strlen($username) > 50) {
            $usernameErr = "Username must be between 5 and 50 characters";
            $isValid = false;
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $isValid = false;
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 100) {
            $emailErr = "Invalid email format or exceeds 100 characters";
            $isValid = false;
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
        $isValid = false;
    } else {
        $password = test_input($_POST["password"]);
        if (strlen($password) < 8 || strlen($password) > 255) {
            $passwordErr = "Password must be between 8 and 255 characters";
            $isValid = false;
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }
    }

    if ($isValid) {
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            header("Location: success.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Redirect back to the form with error messages
        $url = "signup.php?usernameErr=$usernameErr&emailErr=$emailErr&passwordErr=$passwordErr";
        header("Location: $url");
        exit();
    }
}

$conn->close();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

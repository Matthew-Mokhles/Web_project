<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "1234"; // Replace with your MySQL password
$dbname = "bookstore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name']; // If the user changes the name, use the new name
    $email = $_POST['email'];
    $address = $_POST['address'];
    $payment = $_POST['payment'];
    $book = $_POST['book'];
    $price = $_POST['price'];

    $sql = "INSERT INTO orders (name, email, address, payment, book, price) VALUES ('$name', '$email', '$address', '$payment', '$book', '$price')";

    if ($conn->query($sql) === TRUE) {
        header("Location: success.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

// If the user is logged in and the username is stored in the session
if (isset($_SESSION['username'])) {
    $name = $_SESSION['username']; // Set the username as the default value for the name field
} else {
    $name = ""; // If the user is not logged in, leave the name field blank
}

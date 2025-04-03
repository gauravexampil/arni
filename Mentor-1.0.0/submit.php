<?php
$servername = "localhost";
$username = "root";  // Change this based on your database user
$password = "root";  // Change this based on your database password
$dbname = "enquiry_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Insert data into the database
$sql = "INSERT INTO enquiries (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Enquiry submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

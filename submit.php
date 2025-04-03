
<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "arniweb"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['message'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        echo "Received Data: Name = $name, Email = $email, Phone = $phone, Message = $message"; // Debugging output

        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $phone = mysqli_real_escape_string($conn, $phone);
        $message = mysqli_real_escape_string($conn, $message);

        $sql = "INSERT INTO enquiries (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo "Enquiry submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Form data is missing!";
    }
} else {
    echo "Invalid request method!";
}

$conn->close();
?>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database credentials
$host = 'localhost'; // Or your database host
$dbname = 'arniweb';
$username = 'root';
$password = 'root';

// Create a connection to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Debug: Log POST data
// Use var_dump() to see if you are receiving data correctly
// Uncomment the line below to check the submitted data
// var_dump($_POST); 

// Initialize a message variable
$message = '';

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure the data exists in the POST array
    if (isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['message'])) {
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $phone = htmlspecialchars(trim($_POST['phone']));
        $message_content = htmlspecialchars(trim($_POST['message']));

        // Prepare an insert query
        $sql = "INSERT INTO enquiries (name, email, phone, message) VALUES (:name, :email, :phone, :message)";

        // Prepare statement
        $stmt = $pdo->prepare($sql);

        // Bind parameters to prevent SQL injection
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':message', $message_content);

        // Execute the query and check if data was inserted
        if ($stmt->execute()) {
            // If data is inserted successfully, send a success message
            $message = "Thank you for your enquiry. We will get back to you soon!";
        } else {
            $message = "There was an error submitting your form. Please try again later.";
        }
    } else {
        // If data is missing
        $message = "Form data is incomplete. Please fill all the fields.";
    }

    // Return the response to the frontend
    echo $message;
} else {
    echo "Invalid request method.";
}
?>

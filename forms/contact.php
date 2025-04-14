<?php
header('Content-Type: application/json');

$host = "localhost";
$username = "root";
$password = "root";
$database = "arni_institute";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed."]);
    exit();
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$message = $_POST['message'] ?? '';

if ($name && $email && $phone && $message) {
    $stmt = $conn->prepare("INSERT INTO contact_form (name, email, phone, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Message sent successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to save message."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "All fields are required."]);
}

$conn->close();
?>

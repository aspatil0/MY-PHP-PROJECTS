<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "next_hire";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'provider') {
    die("Unauthorized access.");
}

$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$company = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$provider_id = $_SESSION['user_id'];

if ($title && $company && $description && $location && $email) {
    $stmt = $conn->prepare("INSERT INTO jobs (title, company, description, location, email, id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $title, $company, $description, $location, $email, $provider_id);

    if ($stmt->execute()) {
        echo "<script>alert('Job posted successfully!'); window.location.href='index (4).html';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Please fill all fields correctly.');</script>";
}

$conn->close();
?>

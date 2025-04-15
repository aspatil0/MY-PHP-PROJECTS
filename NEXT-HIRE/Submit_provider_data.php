<?php
include 'db_connect.php';

$title = $_POST['title'];
$description = $_POST['description'];
$location = $_POST['location'];

$sql = "INSERT INTO provider_data (title, description, location) VALUES ('$title', '$description', '$location')";

if (mysqli_query($conn, $sql)) {
    echo "Job posted successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
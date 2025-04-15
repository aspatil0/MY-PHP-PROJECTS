<?php
$host = 'localhost';
$user = 'root';
$password = ''; // use your actual password
$dbname = 'next_hire'; // use your actual database name

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

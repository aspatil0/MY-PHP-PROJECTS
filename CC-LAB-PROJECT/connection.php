<?php
$servername = "localhost";      // usually localhost
$username = "root";             // your DB username
$password = "";                 // your DB password (leave blank if none)
$database = "lab_booking";      // your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

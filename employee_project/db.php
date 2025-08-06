<?php
$host = "localhost"; //STAY AS IT IS
$user = "root";  //STAY AS IT IS
$pass = "";  //NULL
$dbname = "company_db";  //IF YOU ARE USING THIS ADD HERE YOUR DB NAME

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>

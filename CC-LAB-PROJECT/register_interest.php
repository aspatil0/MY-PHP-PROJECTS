<?php
include 'connection.php';

$dept = $_POST['dept_name'];
$mobile = $_POST['mobile_no'];

mysqli_query($conn, "INSERT INTO waitlist (dept_name, mobile_no) VALUES ('$dept', '$mobile')");

echo "Registered for next available slot!";
?>


<?php
session_start();
if (!isset($_SESSION['dept'])) header("Location: index.php");

$conn = new mysqli("localhost", "root", "", "lab_booking");
$duration = intval($_POST['duration']);
$free_time = date("H:i:s", time() + $duration * 60);
$conn->query("UPDATE lab_status SET booked=1, booked_by='{$_SESSION['dept']}', free_time='$free_time'");

header("Location: dashboard.php");
?>

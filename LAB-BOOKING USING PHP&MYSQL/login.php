<?php
session_start();

$dept_id = $_POST['dept_id'];
$password = $_POST['password'];

$sql = "SELECT * FROM departments WHERE dept_id='$dept_id' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $dept = $result->fetch_assoc();
    $_SESSION['dept'] = $dept['dept_name'];
    $_SESSION['hod'] = $dept['hod'];
    header("Location: dashboard.php");
} else {
    header("Location: index.php?error=Invalid+credentials");
}
?>

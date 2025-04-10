<?php
include 'connection.php';

$dept_name = $_POST['dept_name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // secure password

// Check if email exists
$check = mysqli_query($conn, "SELECT * FROM departments WHERE email='$email'");
if (mysqli_num_rows($check) > 0) {
    echo "Email already registered!";
    exit;
}

// Insert new department
$query = "INSERT INTO departments (dept_name, email, password) VALUES ('$dept_name', '$email', '$password')";
if (mysqli_query($conn, $query)) {
    echo "Registration successful. <a href='index.html'>Click here to login</a>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>

<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $salary = $_POST['salary'];
    $joining_date = $_POST['joining_date'];

    $sql = "INSERT INTO employees (name, email, phone, department, designation, salary, joining_date) 
            VALUES ('$name', '$email', '$phone', '$department', '$designation', '$salary', '$joining_date')";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>Employee Added Successfully!</h2>";
        echo "<a href='index.php'>Add Another</a> | <a href='view_employees.php'>View Employees</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
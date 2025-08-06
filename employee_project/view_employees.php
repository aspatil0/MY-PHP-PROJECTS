<?php
include 'db.php';
$result = $conn->query("SELECT * FROM employees");

//QUERY TO GET INFO FROM OUR DB SELCT AND THEN RUN IT AS IT GET DATA STORED FROM THE DATABSE AND THEN DISPLAY IT { ADD PROPER DB ANME }
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>All Employees</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Phone</th>
            <th>Department</th><th>Designation</th><th>Salary</th><th>Joining Date</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['department'] ?></td>
            <td><?= $row['designation'] ?></td>
            <td><?= $row['salary'] ?></td>
            <td><?= $row['joining_date'] ?></td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <a href="index.php">Add Employee</a>
</body>
</html>

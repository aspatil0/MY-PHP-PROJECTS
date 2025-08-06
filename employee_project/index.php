<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Employee Registration Form</h1>
    <form action="save_employee.php" method="POST">
        <input type="text" name="name" placeholder="Employee Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="phone" placeholder="Phone" required><br>
        <input type="text" name="department" placeholder="Department" required><br>
        <input type="text" name="designation" placeholder="Designation" required><br>
        <input type="number" name="salary" placeholder="Salary" required><br>
        <label>Joining Date:</label>
        <input type="date" name="joining_date" required><br><br>
        <button type="submit">Save Employee</button>
    </form>
    <br>
    <a href="view_employees.php">View All Employees</a>
</body>
</html>

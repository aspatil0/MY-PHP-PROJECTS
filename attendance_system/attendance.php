<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "attendance_system";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['add_student'])) {
    $student_name = $_POST['name'];
    $roll_number = $_POST['roll'];
    $sql = "INSERT INTO students (name, roll_no) VALUES ('$student_name', '$roll_number')";
    if ($conn->query($sql) === TRUE) {
        $student_id = $conn->insert_id;
        $conn->query("INSERT INTO attendance (student_id) VALUES ($student_id)");
        echo "✅ Student added successfully!";
    } else {
        echo "❌ Error: " . $conn->error;
    }
}

if (isset($_POST['update_attendance'])) {
    $student_id = $_POST['student_id'];
    $attended = $_POST['attended'];
    $total = $_POST['total'];
    $sql = "UPDATE attendance 
            SET attended_classes = attended_classes + $attended, 
                total_classes = total_classes + $total
            WHERE student_id = $student_id";
    $conn->query($sql);
    echo "📌 Attendance updated!";
}

$sql = "SELECT s.id, s.name, s.roll_no, a.attended_classes, a.total_classes 
        FROM students s 
        JOIN attendance a ON s.id = a.student_id";
$result = $conn->query($sql);

echo "<h2>📊 Attendance Report</h2>";
echo "<table border='1' cellpadding='8' cellspacing='0'>
<tr style='background:#f2f2f2'>
<th>Roll No</th>
<th>Name</th>
<th>Attended</th>
<th>Total</th>
<th>Percentage</th>
<th>Status</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    $percentage = ($row['total_classes'] > 0) 
                    ? ($row['attended_classes'] / $row['total_classes']) * 100 
                    : 0;
    $status = ($percentage < 75) ? "<span style='color:red;font-weight:bold'>Defaulter</span>" : "<span style='color:green'>OK</span>";
    echo "<tr>
            <td>{$row['roll_no']}</td>
            <td>{$row['name']}</td>
            <td>{$row['attended_classes']}</td>
            <td>{$row['total_classes']}</td>
            <td>" . round($percentage, 2) . "%</td>
            <td>$status</td>
          </tr>";
}
echo "</table>";
?>

<h3>➕ Add Student</h3>
<form method="POST">
    Name: <input type="text" name="name" required>
    Roll No: <input type="text" name="roll" required>
    <button type="submit" name="add_student">Add</button>
</form>

<h3>📝 Update Attendance</h3>
<form method="POST">
    Student ID: <input type="number" name="student_id" required>
    Attended Classes: <input type="number" name="attended" required>
    Total Classes: <input type="number" name="total" required>
    <button type="submit" name="update_attendance">Update</button>
</form>

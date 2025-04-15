<?php
$conn = new mysqli("localhost", "root", "", "next_hire");

$job_id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];

$sql = "INSERT INTO applications (id, name, email)
        VALUES ('$job_id', '$name', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Application submitted!'); window.location.href='Job Seeker.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>

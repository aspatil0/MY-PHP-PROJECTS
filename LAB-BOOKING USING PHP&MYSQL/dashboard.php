<?php
session_start();
if (!isset($_SESSION['dept'])) {
    header("Location: index.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "lab_booking");
$lab = $conn->query("SELECT * FROM lab_status LIMIT 1")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    body { font-family: sans-serif; padding: 20px; background-color: #f4f4f4; }
    .container { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px; }
    h2 { color: #0d47a1; }
    button { padding: 10px 20px; margin-top: 20px; }
    .lab-status { margin-top: 20px; padding: 15px; background: #e0f7fa; border-left: 5px solid #00838f; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Welcome to <?php echo $_SESSION['dept']; ?> Department</h2>
    <p><strong>HOD:</strong> <?php echo $_SESSION['hod']; ?></p>
    <form method="POST" action="logout.php"><button>Logout</button></form>
    <h3>Lab Status</h3>
    <div class="lab-status">
      <?php
      if ($lab['booked']) {
          echo "Booked by: ".$lab['booked_by']."<br>Available after: ".$lab['free_time'];
      } else {
          echo "Lab is currently available.";
      }
      ?>
    </div>
    <?php if (!$lab['booked']): ?>
    <form method="POST" action="book.php">
      <input type="number" name="duration" placeholder="Duration in minutes" required />
      <button type="submit">Book Lab</button>
    </form>
    <?php endif; ?>
  </div>
</body>
</html>

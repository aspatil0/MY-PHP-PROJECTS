<?php
include 'connection.php';
date_default_timezone_set("Asia/Kolkata");

$today = date("Y-m-d");
$now = date("H:i:s");

// 🔴 CURRENT STATUS CHECK
$current_sql = "SELECT * FROM bookings 
                WHERE booking_date = '$today' 
                AND start_time <= '$now' AND end_time >= '$now'";
$current_result = mysqli_query($conn, $current_sql);

if (mysqli_num_rows($current_result) > 0) {
    $row = mysqli_fetch_assoc($current_result);
    echo "<h2>🔴 Lab Currently Booked</h2>";
    echo "<p><strong>By:</strong> {$row['dept_name']} | <strong>Mobile:</strong> {$row['mobile_no']}<br>";
    echo "<strong>From:</strong> {$row['start_time']} to {$row['end_time']}</p>";

    // 🟨 Join Queue Button
    echo "<h3>📅 Book Next Available Slot</h3>";
    echo "<form action='book_lab.php' method='POST'>
            <input type='hidden' name='booking_date' value='$today'>
            <label>Department Name:</label>
            <input type='text' name='dept_name' required><br><br>

            <label>Mobile Number:</label>
            <input type='text' name='mobile_no' required><br><br>

            <label>Start Time:</label>
            <input type='time' name='start_time' required><br><br>

            <label>End Time:</label>
            <input type='time' name='end_time' required><br><br>

            <input type='submit' value='Request Next Slot'>
          </form>";

} else {
    // 🟢 Lab Free — Direct Booking Form
    echo "<h2>🟢 Lab is Free — Register Now</h2>";
    echo "<form action='book_lab.php' method='POST'>
            <input type='hidden' name='booking_date' value='$today'>
            <label>Department Name:</label>
            <input type='text' name='dept_name' required><br><br>

            <label>Mobile Number:</label>
            <input type='text' name='mobile_no' required><br><br>

            <label>Start Time:</label>
            <input type='time' name='start_time' required><br><br>

            <label>End Time:</label>
            <input type='time' name='end_time' required><br><br>

            <input type='submit' value='Book Lab Now'>
          </form>";
}

// 📋 SHOW FULL QUEUE
echo "<hr><h2>📋 Booking Queue for Today</h2>";
$queue_sql = "SELECT * FROM bookings WHERE booking_date = '$today' ORDER BY start_time ASC";
$queue_result = mysqli_query($conn, $queue_sql);

if (mysqli_num_rows($queue_result) > 0) {
    echo "<table border='1' cellpadding='10'>
            <tr><th>Department</th><th>Mobile</th><th>Start</th><th>End</th></tr>";
    while ($r = mysqli_fetch_assoc($queue_result)) {
        echo "<tr>
                <td>{$r['dept_name']}</td>
                <td>{$r['mobile_no']}</td>
                <td>{$r['start_time']}</td>
                <td>{$r['end_time']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No bookings yet.</p>";
}
?>

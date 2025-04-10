<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dept_name = $_POST['dept_name'];
    $mobile_no = $_POST['mobile_no'];
    $booking_date = $_POST['booking_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Check for clash
    $conflict_query = "SELECT * FROM bookings WHERE booking_date = '$booking_date' 
        AND (start_time < '$end_time' AND end_time > '$start_time')";
    
    $conflict_result = mysqli_query($conn, $conflict_query);

    if (mysqli_num_rows($conflict_result) > 0) {
        echo "<script>alert('Slot already booked. Please choose another time.'); window.location.href='dashboard.php';</script>";
    } else {
        $sql = "INSERT INTO bookings (dept_name, mobile_no, booking_date, start_time, end_time)
                VALUES ('$dept_name', '$mobile_no', '$booking_date', '$start_time', '$end_time')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Slot booked successfully!'); window.location.href='dashboard.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

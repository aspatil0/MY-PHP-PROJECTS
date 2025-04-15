<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "next_hire";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query based on your table structure: jobs(title, company, description, etc.)
$sql = "SELECT id, title, company, description, location, email FROM jobs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Job Listings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
            align-items: normal;
            justify-content: normal;
            
            flex-direction: column;
            align-items: center;
        background-image: url("Images/lock3.png");      
        
            background-size: cover;
            background-position: center;
        }
        .job-card {
            background: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .job-card h2 {
            margin-top: 0;
        }

        .job-card p {
            margin: 5px 0;
        }

        .email {
            font-size: 14px;
            color: #007bff;
        }

        .apply-btn {
            display: inline-block;
            margin-top: 10px;
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .apply-btn:hover {
            background-color: #218838;
        }
        h1{
          text-align: center;
        }
    </style>
</head>
<body>

    <h1>Available Jobs</h1>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='job-card'>";
            echo "<h2>" . htmlspecialchars($row["title"]) . "</h2>";
            echo "<p><strong>Company:</strong> " . htmlspecialchars($row["company"]) . "</p>";
            echo "<p><strong>Description:</strong> " . nl2br(htmlspecialchars($row["description"])) . "</p>";
            echo "<p><strong>Location:</strong> " . htmlspecialchars($row["location"]) . "</p>";
            echo "<p class='email'><strong>Contact:</strong> " . htmlspecialchars($row["email"]) . "</p>";
            echo "<a class='apply-btn' href='detail.php?job_id=" . urlencode($row["id"]) . "'>Apply Job</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No job postings found.</p>";
    }

    $conn->close();
    ?>

</body>
</html>

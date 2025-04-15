<?php
session_start(); // Start the session

$conn = new mysqli("localhost", "root", "", "next_hire");

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the user is logged in and the session contains the provider's email
if (!isset($_SESSION['email'])) {
    die("Unauthorized access. Please log in.");
}

$provider_email = $_SESSION['email']; // Get the provider's email from the session

// Use prepared statement to fetch jobs
$stmt = $conn->prepare("SELECT * FROM jobs WHERE email = ?");
$stmt->bind_param("s", $provider_email);
$stmt->execute();
$jobs_result = $stmt->get_result();

if ($jobs_result->num_rows > 0) {
    echo "<h2>Logged in as: " . htmlspecialchars($provider_email) . "</h2>";
    echo "<h3>Jobs found: " . $jobs_result->num_rows . "</h3>";

    while ($job = $jobs_result->fetch_assoc()) {
        $job_id = $job['id'];

        echo "<h3>Job Title: " . htmlspecialchars($job['title']) . "</h3>";
        echo "<p><strong>Job ID:</strong> " . $job_id . "</p>";
        echo "<p><strong>Company:</strong> " . htmlspecialchars($job['company']) . "</p>";
        echo "<p><strong>Description:</strong> " . htmlspecialchars($job['description']) . "</p>";
        echo "<p><strong>Location:</strong> " . htmlspecialchars($job['location']) . "</p>";

        // Fetch applications for this job using prepared statement
        $app_stmt = $conn->prepare("SELECT * FROM applications WHERE job_id = ?");
        $app_stmt->bind_param("i", $job_id);
        $app_stmt->execute();
        $apps_result = $app_stmt->get_result();

        if ($apps_result->num_rows > 0) {
            echo "<h4>Applications:</h4>";
            while ($app = $apps_result->fetch_assoc()) {
                echo "<p><strong>Name:</strong> " . htmlspecialchars($app['name']) . "</p>";
                echo "<p><strong>Email:</strong> " . htmlspecialchars($app['email']) . "</p>";
                echo "<p><strong>Qualification:</strong> " . htmlspecialchars($app['qualification']) . "</p>";
                echo "<p><strong>Experience:</strong> " . htmlspecialchars($app['experience']) . "</p>";
                echo "<p><strong>Skills:</strong> " . htmlspecialchars($app['skills']) . "</p>";
                if (!empty($app['resume'])) {
                    echo "<p><strong>Resume:</strong> <a href='" . htmlspecialchars($app['resume']) . "' target='_blank'>Download</a></p>";
                }
                echo "<hr>";
            }
        } else {
            echo "<p><em>No applications yet for this job.</em></p>";
        }

        $app_stmt->close();
        echo "<hr>";
    }
} else {
    echo "<p>No jobs posted yet.</p>";
}

$stmt->close();
$conn->close();
?>
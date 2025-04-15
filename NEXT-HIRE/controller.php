<?php
// Database Connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "next_hire";

$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle incoming POST actions
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    // SEEEKER REGISTRATION
    if ($action == 'register_seeker') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "INSERT INTO 'login (name, email, password)' VALUES ('$name', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo "Seeker registered successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    // SEEKER LOGIN
    elseif ($action == 'login_seeker') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM 'login' WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        echo mysqli_num_rows($result) === 1 ? "Seeker Login Successful!" : "Invalid Seeker Credentials.";
    }

    // PROVIDER REGISTRATION
    elseif ($action == 'register_provider') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "INSERT INTO 'login (name, email, password)' VALUES ('$name', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo "Provider registered successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    // PROVIDER LOGIN
    elseif ($action == 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM 'login' WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        echo mysqli_num_rows($result) === 1 ? "Provider Login Successful!" : "Invalid Provider Credentials.";
    }

    // PROVIDER JOB POSTING
    elseif ($action == 'post_job') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $location = $_POST['location'];

        $sql = "INSERT INTO provider_data (title, description, location) VALUES ('$title', '$description', '$location')";
        if (mysqli_query($conn, $sql)) {
            echo "Job posted successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    else {
        echo "Unknown action requested.";
    }
} else {
    echo "No action or invalid request method.";
}
?>
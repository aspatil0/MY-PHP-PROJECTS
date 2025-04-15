<?php
session_start();
include_once 'db_connect.php'; // Include database connection

// Check if the user is logged in and is a provider
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'provider') {
    header("Location: Login_provider.php"); // Redirect to login if not logged in or not a provider
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $job_title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $company_name = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $job_description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if ($job_title && $company_name && $job_description && $location && $email) {
        // Insert job posting into the database
        $stmt = $conn->prepare("INSERT INTO job_postings (job_title, company_name, job_description, location, email, provider_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $job_title, $company_name, $job_description, $location, $email, $_SESSION['user_id']);

        if ($stmt->execute()) {
            echo "<script>alert('Job posted successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Please fill all fields correctly.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Next Hire</title>
  <style>
    * {
      box-sizing: border-box;
    }



    body {
      margin: 0;
      font-family: Arial, sans-serif;
      text-align: center;
      }
      .top-left {
      color: black;
      font-size: 28px;
      font-weight: bold;
      text-transform: uppercase;
        letter-spacing: 1px;
    }

    .top-container {
      display: flex;
      justify-content: space-between;  
      align-items: center;  
      background-color: rgba(255, 255, 255, 0.7); 
      padding: 10px 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        
    }
    
    .navbar {
      display: flex;
    }

    .navbar a {
      color: black;  
      text-decoration: none;
      margin-left: 25px;
      padding: 20px;
      border-radius: 20px;
      transition: background-color 0.3s;
      font-size: 20px;
     
    }
    .container
    {
        display: flex;
      justify-content: space-between;  
      align-items: center;  
      background-color: rgba(255, 255, 255, 0.7); 
      padding: 10px 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        margin-top: 180px;
        margin-left: 300px;
        margin-right: 300px;
        border-radius: 10px;
        height:450px;
        width: 800px;
        background-color: white;
        border: 2px solid #ccc;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        padding: 20px;
        border-radius: 10px;
        font-size: 20px;
        display: flexbox;
        flex-direction: column;
        
    }
    .form-container {
            width: 60%;
            margin: 50px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 150px;
        }
    .form-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .form-group label {
            font-size: 18px;
            font-weight: bold;
            width: 150px;
            text-align: left;
        }

        .form-group input, 
        .form-group textarea {
            width: 70%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: vertical;
        }

        .submit-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
      
</head>
<body>

  <div class="top-container">
    
    <div class="top-left">Next Hire</div>
    
    <div class="navbar">
      <a href="index (4).html">Home</a>
      <a href="">About Us</a>
      <a href="">Contact Us</a>
     
      
    </div>
  </div>
  <img src="Images/provider.png" alt="Logo" style="width: 1500px; height: 600px; margin: 10px auto; display: flexbox; position: fixed; top:11%; left: 50%; transform: translateX(-50%); z-index: -1;">
  <div class="form-container">
    <h1>Job Opening</h1>
    <form id="jobForm" action="submit_job.php" method="POST">
    <div class="form-group">
            <label for="title">Job Title:</label>
            <input type="text" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="company">Company Name:</label>
            <input type="text" id="company" name="company" required>
        </div>

        <div class="form-group">
            <label for="description">Job Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <button type="submit" class="submit-btn">Submit</button>
    </form>
</div>
    
  </div>
</body>
</html>

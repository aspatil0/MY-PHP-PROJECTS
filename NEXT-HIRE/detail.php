<?php
// Enable error reporting for debugging
if (!$job_id) {
  die("Error: Job ID is missing or invalid.");
} else {
  echo "Job ID: " . htmlspecialchars($job_id) . "<br>";
}
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once 'db_connect.php'; // Database connection

$job_id = $_GET['job_id'] ?? null; // Get job_id from URL if present

$message = ''; // For showing feedback message

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate input
    $name = htmlspecialchars(trim($_POST["name"]));
    $qualification = htmlspecialchars(trim($_POST["qualification"]));
    $experience = htmlspecialchars(trim($_POST["experience"]));
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $skills = htmlspecialchars(trim($_POST["skills"]));
    $job_id = isset($_POST["job_id"]) ? (int)$_POST["job_id"] : null;

    // Handle resume upload
    $resume = $_FILES['resume'] ?? null;
    $resume_path = null;

    if ($resume && $resume['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create upload directory if not exists
        }

        $file_name = basename($resume['name']);
        $target_path = $upload_dir . uniqid() . "_" . $file_name;
        if (move_uploaded_file($resume['tmp_name'], $target_path)) {
            $resume_path = $target_path;
        } else {
            $message = "Error uploading resume.";
        }
    }

    // Validation before inserting
    if (!empty($name) && !empty($qualification) && !empty($email) && !empty($skills) && !empty($job_id)) {
        $stmt = $conn->prepare("INSERT INTO applications (job_id, name, qualification, experience, email, skills, resume) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("issssss", $job_id, $name, $qualification, $experience, $email, $skills, $resume_path);

            if ($stmt->execute()) {
                $message = "Thank you, <strong>$name</strong>! Your application for job ID <strong>$job_id</strong> has been submitted.";
            } else {
                $message = "Database Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $message = "Prepare failed: " . $conn->error;
        }
    } else {
        $message = "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Application Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .form-container {
      background: white;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      max-width: 450px;
      width: 100%;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    button {
      margin-top: 20px;
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      background-color: #45a049;
    }

    .message {
      margin-top: 20px;
      font-size: 16px;
      text-align: center;
      color: green;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Application Form</h2>

    <?php if (!empty($message)): ?>
      <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if ($job_id): ?>
      <p style="text-align:center;">Applying for Job ID: <strong><?php echo htmlspecialchars($job_id); ?></strong></p>
    <?php endif; ?>

    <form action="apply.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job_id); ?>">

      <label for="name">Full Name</label>
      <input type="text" id="name" name="name" required placeholder="Enter your name">

      <label for="qualification">Qualification</label>
      <select id="qualification" name="qualification" required>
        <option value="" disabled selected>Select your qualification</option>
        <option value="High School">High School</option>
        <option value="Diploma">Diploma</option>
        <option value="Bachelor's Degree">Bachelor's Degree</option>
        <option value="Master's Degree">Master's Degree</option>
        <option value="PhD">PhD</option>
      </select>

      <label for="experience">Experience</label>
      <input type="text" id="experience" name="experience" placeholder="Enter your experience (if any)">

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required placeholder="Enter your email">

      <label for="skills">Skills</label>
      <input type="text" id="skills" name="skills" required placeholder="Enter your skills (comma separated)">

      <label for="resume">Upload Resume</label>
      <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" required>

      <button type="submit">Submit</button>
    </form>
  </div>
</body>
</html>

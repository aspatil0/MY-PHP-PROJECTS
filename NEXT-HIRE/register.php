<?php
include_once 'db_connect.php'; // Assumes db_connect.php has your DB credentials

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get and sanitize form data
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT); // hash password
    $role = filter_input(INPUT_POST, 'job_role', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Simple validation
    if ($first_name && $last_name && $email && $password && ($role === 'provider' || $role === 'seeker')) {
        // Prepare SQL
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $first_name, $last_name, $email, $password, $role);

        if ($stmt->execute()) {
            // Redirect based on role
            if ($role === 'provider') {
                header("Location: login_provider.php");
            } elseif ($role === 'seeker') {
                header("Location: login_seeker.php");
            }
            exit(); // Ensure no further code is executed
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please fill all fields correctly.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      height: 100vh;
      font-family: 'Poppins', sans-serif;
      background: url("Images/WhatsApp Image 2025-04-03 at 22.11.19_fca6688f.jpg") no-repeat center center / cover;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(15px);
      border-radius: 20px;
      padding: 50px 40px;
      width: 90%;
      max-width: 600px;
      color: white;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
    }

    .container h3 {
      font-size: 2.5rem;
      margin-bottom: 30px;
      text-align: center;
      letter-spacing: 1.5px;
    }

    form .row {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }

    .col {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    label {
      font-weight: 500;
      margin-bottom: 8px;
    }

    input, select {
      padding: 12px 15px;
      border: none;
      border-radius: 10px;
      font-size: 1rem;
      background: rgba(255, 255, 255, 0.2);
      color: white;
      outline: none;
      transition: 0.3s;
    }

    input::placeholder {
      color: #e0e0e0;
    }

    input:focus, select:focus {
      background: rgba(255, 255, 255, 0.3);
    }

    select {
      appearance: none;
    }

    .submit-btn {
      margin-top: 30px;
      width: 100%;
      padding: 15px;
      background: #ffd369;
      color: #000;
      font-size: 1.2rem;
      font-weight: bold;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .submit-btn:hover {
      background: #ffbe33;
    }

    .login-link {
      margin-top: 25px;
      text-align: center;
      font-size: 1rem;
    }

    .login-link a {
      color: #ffd369;
      text-decoration: none;
      font-weight: 500;
    }

    @media (max-width: 600px) {
      .row {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h3>Register</h3>
    <form id="register-form" action="#" method="POST">
              <div class="row">
        <div class="col">
          <label for="first-name">First Name</label>
          <input type="text" id="first-name" name="first_name" placeholder="First Name" required>        </div>
        <div class="col">
          <label for="last-name">Last Name</label>
<input type="text" id="last-name" name="last_name" placeholder="Last Name" required>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="col">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <label for="job-role">Role</label>
          <select id="job-role" name="job_role" required>
            <option value="" disabled selected>Select your role</option>
            <option value="provider">Provider</option>
            <option value="seeker">Seeker</option>
          </select>
        </div>
      </div>

      <button type="submit" class="submit-btn">Submit</button>

      <p class="login-link">
        Already have an account?<br>
         <a href="login_provider.php">Login as job provider</a><br>
         <a href="login_seeker.php">Login as job seeker</a>
      </p>
    </form>
    
  </div>
</body>
</html>

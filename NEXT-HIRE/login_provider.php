<?php
session_start();
include_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if ($email && $password) {
        $stmt = $conn->prepare("SELECT id, first_name, last_name, password, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id, $first_name, $last_name, $hashed_password, $role);
            $stmt->fetch();

            // DEBUG: Uncomment the next line to see what is retrieved
            // echo "Role from DB: $role, Password match: " . (password_verify($password, $hashed_password) ? "Yes" : "No");

            if ($role === 'provider') {
                if (password_verify($password, $hashed_password)) {
                    $_SESSION['user_id'] = $id;
                    $_SESSION['first_name'] = $first_name;
                    $_SESSION['role'] = $role;
                    $_SESSION['email'] = $email;
                    header("Location: Job-provider.php");
                    exit();
                } else {
                    echo "❌ Incorrect password.";
                }
            } else {
                echo "❌ You are not a provider. Please use the seeker login.";
            }
        } else {
            echo "❌ No user found with that email.";
        }

        $stmt->close();
    } else {
        echo "❌ Please enter both email and password.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
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
      background: url("Images/lock3.jpg") no-repeat center center / cover;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(15px);
      border-radius: 20px;
      padding: 50px 40px;
      width: 95%;
      max-width: 400px;
      color: white;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
      text-align: center;
    }

    h2 {
      font-size: 2.5rem;
      margin-bottom: 30px;
      letter-spacing: 1px;
    }

    label {
      display: block;
      text-align: left;
      margin: 15px 0 8px;
      font-size: 1rem;
      font-weight: 500;
    }

    input {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.2);
      color: white;
      font-size: 1rem;
      transition: background 0.3s ease;
    }

    input::placeholder {
      color: #e0e0e0;
    }

    input:focus {
      background: rgba(255, 255, 255, 0.3);
      outline: none;
    }

    button {
      margin-top: 30px;
      width: 100%;
      padding: 12px;
      background: #ffd369;
      color: #000;
      font-size: 1.1rem;
      font-weight: bold;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background: #ffbe33;
    }

    .register-link {
      margin-top: 20px;
      font-size: 1rem;
    }

    .register-link a {
      color: #ffd369;
      text-decoration: none;
      font-weight: 500;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Login</h2>
    <form action="" method="POST">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required>

      <button type="submit">Submit</button>
    </form>
    <p class="register-link">Don't have an account? <a href="register.php">Register</a></p>
  </div>
</body>
</html>

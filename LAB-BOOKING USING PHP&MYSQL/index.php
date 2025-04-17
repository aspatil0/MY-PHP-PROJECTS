<?php
session_start();
if (isset($_SESSION['dept'])) {
    header("Location: dashboard.php");
    exit();
}
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lab Booking Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #e3f2fd, #ffffff); margin: 0; padding: 0; }
    .container { max-width: 500px; margin: 100px auto; padding: 30px; background-color: white; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
    h2 { text-align: center; color: #0d47a1; margin-bottom: 20px; }
    input, button { width: 100%; padding: 12px; margin-top: 10px; font-size: 1rem; border-radius: 6px; border: 1px solid #ccc; }
    button { background-color: #0d47a1; color: white; border: none; cursor: pointer; transition: background 0.3s ease; }
    button:hover { background-color: #1565c0; }
    p { color: red; text-align: center; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Lab Booking Login</h2>
    <form method="POST" action="login.php">
      <input type="text" name="dept_id" placeholder="Department ID" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
    <?php if (isset($_GET['error'])) echo "<p>".$_GET['error']."</p>"; ?>
    
  </div>
</body>
</html>

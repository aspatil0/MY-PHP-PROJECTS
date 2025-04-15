<?php
session_start();

// Check if the user is logged in and is a provider
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'provider') {
    header("Location: Login_provider.php"); // Redirect to login if not logged in or not a provider
    exit();
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

    .top-left {
      color: black;
      font-size: 28px;
      font-weight: bold;
      text-transform: uppercase;
        letter-spacing: 1px;
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

    .content
    {
        margin-top: 60px;
        position: fixed;
        text-align: center;
        left: 20%;
    }
    .navbar a:hover {
      background-color: #f0f0f0;  
    }
    h1 {
      font-size: 40px;
      color: black;
      font-weight: bold;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-top: 50px;
      text-align: center;
      position: relative;
      align-items: center;
    }
    
  </style>
  
</head>
<body>
   
<div class="top-container">
    
    <div class="top-left">Next Hire</div>
    
    <div class="navbar">
      <a href="">Home</a>
      <a href="">About Us</a>
      <a href="">Contact Us</a>
      <a href="">Login/Register</a>
      
    </div>
</diV>
<div class="content">
   
    <h1>FIND THE BEST TALENT FOR YOUR JOB</h1>
    </div>

  <img src="Images/Job.png" alt="Logo" style="width: 800px; height: 500px; margin: 10px auto; display: flex; position: fixed; top:23%; left: 50%; transform: translateX(-50%); z-index: -1;">
  <div class="button">
    <a href="ProviderForm.php" style="text-decoration: none; color: white; background-color: #3515c3; padding: 15px 25px; border-radius: 5px; font-size: 20px; align-items: center;margin-top: 640px; display: inline-block;left: 550px; position: fixed;">Post Job</a>
    <a href="provider_dashboard.php" style="text-decoration: none; color: white; background-color: #3515c3; padding: 15px 25px; border-radius: 5px; font-size: 20px; margin: left 100px; ;margin-top: 640px; display: inline-block;left: 750px; position: fixed;">View Applicatios</a>

  </div>
</body>
</html>

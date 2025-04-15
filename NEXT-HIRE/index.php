<?php
session_start();
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
    </style>
</head>
<body>

  <div class="top-container">
    
    <div class="top-left">Next Hire</div>
    
    <div class="navbar">
      <a href="index.html">Home</a>
      <a href="">About Us</a>
      <a href="">Contact Us</a>
      <a href="register.html">Login/Register</a>
      
    </div>
  </div>
  <img src="Images/homepage.png" alt="Logo" style="width: 1500px; height: 600px; margin: 10px auto; display: flexbox; position: fixed; top:11%; left: 50%; transform: translateX(-50%); z-index: -1;">
</body>
</html>

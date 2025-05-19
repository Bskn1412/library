<?php
include('../config/session_check.php');
include(__DIR__ . '/../../dbconn.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Index Page</title>
  <style>
  
    html, body {
      top: 0;
      right: 0;
      margin: 0;
      height: 100vh;
      background-color:black;
    }
 
    .container {
      display: flex;
      flex-direction: column;
      height: 100vh;
    }
   
    .top {
      height: 20%;
    }

    .left {
      width: 20%;
      height: 100%;
    }
   
    .bottom {
      flex: 1;
      display: flex;
    }

   .right {
      flex: 1;
      width: 30%;
      border: 2px solid rgb(239, 227, 227);
      padding: 20px;
      box-shadow: 
        inset 0 0 8px rgba(255, 255, 255, 0.5),   /* base inner glow */
        0 0 10px rgba(255, 255, 255, 0.7);        /* base outer glow */
      transition: box-shadow 0.4s ease;
       border-radius: 10px;
    }
    .right:hover {
      box-shadow: 
        inset 0 0 15px rgba(255, 255, 255, 0.7),  /* stronger inner glow */
        0 0 20px rgba(255, 255, 255, 0.5);        /* stronger outer glow */
    }

    iframe {
      width: 100%;
      height: 100%;
      border: none;
    }
    a{
      font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
      text-decoration: none;
      font-size: 20px;
      color:rgb(248, 17, 17);
      margin-left: 30px;
      letter-spacing: .1rem;
    }
  
  </style>
</head>
<body>
  <div class="container">
    <div class="top">
      <iframe name="11" src="logo.php" target="13"></iframe>
    </div>
    <div class="bottom">
      <div class="left">
        <iframe name="12" src="left.php" target="13"></iframe>
      </div>
      <div class="right">
        <iframe name="13" src="quote.html"></iframe>
      </div>
    </div>
  </div>
  <a href="../logout.php">Logout</a>
</body>
</html>

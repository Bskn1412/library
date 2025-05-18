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
      margin: 0;
      padding: 0;
      height: 100%;
      background-color: #0d1117;
    }
 
    .container {
      display: flex;
      flex-direction: column;
      height: 100%;
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
        <iframe name="13"></iframe>
      </div>
    </div>
  </div>
</body>
</html>
<a href="../logout.php">Logout</a>
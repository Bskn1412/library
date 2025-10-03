<?php
include(__DIR__ . '/../config/session_check.php');
?>

<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      margin: 0;
      padding: 20px;
      font-family: 'Times New Roman', Times, serif;
      display: flex;
      flex-direction: column;
      height: 100vh;
      box-sizing: border-box;
    }

    /* wrapper for all buttons */
    .menu {
      flex: 1; /* takes all space before logout */
    }

    .btn {
      display: block;
      width: 200px;
      padding: 10px;
      margin: 12px 0;
      text-align: center;
      text-decoration: none;
      font-size: 18px;
      font-weight: bold;
      color: #000;
      background-color: #fff;
      border: 2px solid #ccc;
      border-radius: 6px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn:hover {
      border-radius: 10px;
      border-color: #999;
      background: #f0f0f0;
    }

    /* logout link fixed at bottom */
    .logout {
      font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
      font-size: 20px;
      color: rgb(248, 17, 17);
      letter-spacing: .1rem;
      margin-top: auto;   /* pushes logout to bottom */
    }

    /* Gap for right frame (extra spacing on right side) */
    body {
      padding-right: 40px; /* adjust this gap as needed */
    }

    /* Mobile (<= 768px) */
    @media (max-width: 768px) {
      .btn {
        width: 100%;
        font-size: 16px;
      }

    }

    /* Small Mobile (<= 480px) */
    @media (max-width: 480px) {
      .btn {
        font-size: 14px;
        padding: 8px;
      }
    }
  </style>
</head>
<body>
  <div class="menu">
    <a class="btn" href="insert_students.php" target="13">Students Insertion</a>
    <a class="btn" href="insert_faculty.php" target="13">Faculty Insertion</a>
    <a class="btn" href="delete_student.php" target="13">Students Deletion</a>
    <a class="btn" href="delete_faculty.php" target="13">Faculty Deletion</a>
    <a class="btn" href="view_students.php" target="13">View Students</a>
    <a class="btn" href="batch_update.php" target="13">Batch Update</a>
  </div>

  <a class="btn logout" href="../logout.php" target="_top">Logout</a>
</body>
</html>

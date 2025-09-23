<?php
include(__DIR__ . '/../config/session_check.php');
?>

<!DOCTYPE html>
<html>
<head>
    <style>

a {
    display: block;
    width: 200px; 
    padding: 2px;
    margin: 8px 5px;
    text-align: center;
    text-decoration: none;
    font-size: 20px;
    color:rgb(0, 0, 0);
    font-family: 'Times New Roman', Times, serif;
    font-weight: bold;
    
}
body {
  margin-left: 30px;
  margin-top: 10px;
  align-items: center;
  justify-content: center;
}
button {
    background-color: white;
    margin-top: 30px;
    position: relative;
    letter-spacing: .1em;
    &:hover {
        cursor: pointer;
        border-radius: 10px 10px;   
}
}
</style>
</head>
<body>
    <button ><a href="insert_students.php" target="13">Students Insertion</a></button>
    <button ><a href="insert_faculty.php" target="13">Faculty Insertion</a></button>
    <button ><a href="delete_student.php" target="13">Students Deletion</a></button>
    <button ><a href="delete_faculty.php" target="13">Faculty Deletion</a></button>
    <button ><a href="view_students.php" target="13">View Students</a></button>
    <!-- <a href="add_branch.html" target="13">Add Branch</a> -->
    <button ><a href="batch_update.php" target="13">Batch Update</a></button>
</body>
</html>
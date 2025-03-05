<?php
$conn=new mysqli("localhost","root","","libre");
if($conn->connect_error)
{
  die("Connection failed: ".$conn->connect_error);
}
?>
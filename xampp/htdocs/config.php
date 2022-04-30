<?php
$servername = "server name";
$username = "DB Username";
$password = "DB Password";
$dbname = "Data Base Name";
$servername = "localhost";
$username = "Shubham";
$password = "Shubham";
$dbname = "fmoji";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
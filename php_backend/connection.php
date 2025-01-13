<?php
$hostname="localhost";
$username= "root";
$password= ''; 
$dbname= "universitymarketplace";
$conn=new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("you database connection failed,check the connection.". $conn->connect_error);
}
?>
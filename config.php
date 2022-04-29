<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appdashboard";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$serveradd='http://'.$_SERVER['SERVER_NAME'].'/appdashboard/JSON/';
$serverimg='http://'.$_SERVER['SERVER_NAME'].'/appdashboard/';
$defimg=$serverimg.'uploads/default-image/defaultimage.png';

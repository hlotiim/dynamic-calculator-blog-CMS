<?php
// Database connection credentials
$servername = "localhost";
$username = "demo";
$password = "demo";
$dbname = "demo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the domain of the website
$D = $_SERVER['HTTP_HOST'];
$domain = preg_replace('/^www\./', '', $D);
$domainwithhttps = 'https://' . $D;
$domainwithwww = 'www.' . $D;


?>

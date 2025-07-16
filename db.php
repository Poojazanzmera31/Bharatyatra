<?php
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bharatyatra_db";

// Create connection using MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to avoid issues with special characters
$conn->set_charset("utf8");
?>
<?php
$servername = "localhost";
$username = "robinza202_tickets";
$password = "tickets";
$dbname = "robinza202_tickets";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
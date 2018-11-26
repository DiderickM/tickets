<?php
$servername = "localhost";
$username = "didervr261_tickets";
$password = "geentickets";
$dbname = "didervr261_tickets";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
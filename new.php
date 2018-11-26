<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tickets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
</head>
<?php

include_once('conn.php');

if (isset($_COOKIE['value'])) {
    echo '<center><h1 style="font-size:100px; margin-top: 20%;">Je bent nummer ' . $_COOKIE['value'] . '!</h1></center>';
} else {
    if (isset($_POST['code']) && isset($_POST['naam'])) {
        $code = $_POST['code'];
        $naam = $_POST['naam'];
    
        $sql = "SELECT ticket FROM tickets WHERE klas = '$code' ORDER BY ticket DESC LIMIT 1";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $max = $row['ticket'] + 1;
                $sql = "INSERT INTO tickets (ticket, naam, klas) VALUES ('$max', '$naam', '$code')";
    
                $cookie_name = "value";
                $cookie_value = $max;
                setcookie($cookie_name, $cookie_value, time() + (300), "/");
    
                echo '<center><h1 style="font-size:100px; margin-top: 20%;">Je bent nummer ' . $max . '!</h1></center>';

                if ($conn->query($sql)) {
                } else {
                    echo "Houston, we got a problem";
                }
            }
        } else {
            echo 'Sorry, deze klas lijkt niet te bestaan man. Vet-balen.';
        }
    }
}

?>
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

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

include_once('conn.php');


if (!isset($_COOKIE['klas'])) {
    $nowValue = 1;
    $code = generateRandomString(5);
    setcookie('klas', $nowValue, time() + 7200, "/");
    setcookie('code', $code, time() + 7200, "/");
} else {
    $nowValue = $_COOKIE['klas'] + 1;
    setcookie('klas', $nowValue, time() + 7200, "/");
    $code = $_COOKIE['code'];
}

    $sql = "INSERT INTO tickets (ticket, naam, klas) VALUES (0, 'Started', '$code')";

    if ($conn->query($sql)) {
        echo '<center><h1 style="font-size:100px; margin-top: 15%;">Code: ' . $code . '</h1></center>';
        $sql = "SELECT naam, ticket FROM tickets WHERE ticket = '$nowValue' AND klas = '$code'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                setcookie('klas', $nowValue, time() + 300, "/");
                echo '<center><h1 style="font-size:100px; margin-top: 20px;">Aan de beurt: ' . $nowValue . ': ' . $row['naam'] . '</h1><br>';
                echo '<input class="btn purple" type="button" value="Refresh Page" onClick="window.location.reload()"></center>';
            }
        } else {
            $nowValue -= 1;
            setcookie('klas', $nowValue, time() + 300, "/");
            $sql = "SELECT naam, ticket FROM tickets WHERE ticket = '$nowValue' AND klas = '$code'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<center><h1 style="font-size:100px; margin-top: 20px;">Aan de beurt: ' . $nowValue . ': ' . $row['naam'] . '</h1><br>';
                    echo '<input class="btn purple" type="button" value="Refresh Page" onClick="window.location.reload()"></center>';
                }
            }
        }
    } else {
        echo "Houston, we got a problem";
    }

?>
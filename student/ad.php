<?php

/* Start the session for the username */
session_start();

/* Connect to the database to save all of the clicks */
include_once('../conn.php');

/* The URI where we want to send the users */
$TARGET_URI = 'https://www.youtube.com/watch?v=lXMskKTw3Bc';

$klascode   = $_COOKIE['usercode'];
$ip         = $_SERVER['REMOTE_ADDR'];

/* Set the username. The user can choose to refuse cookies. Then it will be set as session. */
if (isset($_COOKIE['username'])) {
  $naam = $_COOKIE['username'];
} else {
  $naam = $_SESSION['username'];
}

$sql        = "INSERT INTO ads (goal, ip, naam, klascode) VALUES ('$TARGET_URI', '$ip', '$naam', '$klascode')";

/* We do not check whether this was succesful, since this is not the problem of the user. */
$conn->query($sql);

/* Redirect the user to the target website */
header('Location: ' . $TARGET_URI);

?>
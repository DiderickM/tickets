<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../conn.php');

if (!isset($_GET['code'])) {
    //de code is er niet dus dan kan je ook geen data opvragen
    $newURL = "create_class.php";
    header('Location: '.$newURL);//ga maar een code aanvragen
} else {
    $klas = $_GET['code'];
    // Perform queries 
    $result = mysqli_query($conn,"SELECT ticket, naam FROM `tickets` WHERE ticket != 0 AND klas = '$klas'");
    mysqli_close($conn);
    $rowcount=mysqli_num_rows($result);
    $dataArray = array();
    if($rowcount != 0){
        while ($row = $result->fetch_assoc()) {
            $ticket =  $row['ticket'];
            array_push($dataArray, $ticket);
            $naam = $row['naam'];
            array_push($dataArray, $naam);
        }
        $output = implode(', ', $dataArray);
        echo $output;
    }
}


?>
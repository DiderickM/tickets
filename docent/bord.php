<!DOCTYPE html>
<html lang="nl">
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113150562-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-113150562-2');
</script>

<!-- Hotjar Tracking Code for https://skiffle.nl -->
    <script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1109995,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tickets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="../css/main.css">
    <link type="text/css" rel="stylesheet" href="../css/tickets.css">
    <link type="text/css" rel="stylesheet" href="../css/rainbow.css">
<!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
<!-- list libarary files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/utils/Draggable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/TweenMax.min.js"></script>
<!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<!-- other -->
    <script src="../js/list.js"></script>
    <script src="../js/functions.js"></script>
</head>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../conn.php');

function generateRandomString($length, $conn) {
    $characters = '0123456789abcdefghjkmnoprstuvwxyzABCDEFGHJKMNOPRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    if(codeExist($randomString, $conn)){
        return $randomString;
    }else{
        generateRandomString(5, $conn);
    }
}


//bekijkt of de code al in de database bestaat
function codeExist($code, $conn){
    $sql2 = "SELECT klas FROM tickets WHERE klas ='$code'";
    if ($conn->query($sql2)) {
        $result = $conn->query($sql2);
        $num_rows = mysqli_num_rows($result);
        if($num_rows === 0){
            return true;
        }else{
            return false;
        }
    }else{
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $sql2;
        die($message);
    }
}


if (!isset($_COOKIE['Leerlingnum'])) {
    $nowValue = 1;
    $code = generateRandomString(5, $conn);
    setcookie('Leerlingnum', $nowValue, time() + 7200, "/docent");
    setcookie('code', $code, time() + 72000, "/");
    $datum = date("Y-m-d h:i:sa");
    $sql = "INSERT INTO tickets (ticket, naam, klas, datum) VALUES (0, 'Started', '$code', '$datum')";
    if (!$conn->query($sql)) {
        echo 'Houton, we got a problem';
    }
} else {
    $nowValue = $_COOKIE['Leerlingnum'];
    setcookie('Leerlingnum', $nowValue, time() + 7200, "/docent");
    $code = $_COOKIE['code'];
}
$sql = "SELECT naam, ticket FROM tickets WHERE ticket = '$nowValue' AND klas = '$code'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        setcookie('Leerlingnum', $nowValue, time() + 7200, "/docent");
    }
} else {
    $nowValue -= 1;
    setcookie('Leerlingnum', $nowValue, time() + 7200, "/docent");
}
$sql = "SELECT naam, ticket FROM tickets WHERE ticket = '$nowValue' AND klas = '$code'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $name = $row['naam'];
    }
}
?>

<div class="ticket">
  <div class="stub">
    <div class="top">
      <span class="admit">Nummer</span>
      <span class="line"></span>
      <span class="num">
        Invitation
        <span>31415926</span>
      </span>
    </div>
    <div class="number"><?php echo $nowValue ?></div>
  </div>
  <div class="check">
    <div class="big">
      Klas Code: <br><span><?php echo $code?></span>
    </div>
    <div class="number"><?php echo $nowValue ?></div>
    <div class="info">
        <section>
            <div class="title">Date</div>
            <div><?php echo date("d.m.y")?></div>
        </section>
        <section>
            <div class="title">Naam</div>
            <div><?php echo $name ?></div>
        </section>
        <section>
            <div class="title"></div>
            <input class="btn yellow" type="button" value="Volgende" onclick="leerlingnummer(1)" style="margin: 0px; font-size: 1 em; padding: .8em 2em .8em 2em;">
        </section>
   </div>
  </div>
</div>
<div id="" style="overflow:auto;padding-top:5em; height:20em;">
<section class="container" id="myList">
<!--
<div class="list-item">
    <div class="item-content">
    <span class="order">1</span> Alpha
    <a class="btn red" style="float: right; height: 2.5em; line-height: 1.25em;">X</a>
    </div>
</div>
-->
</section>
</div>
<div class="center">
    <a class="btn red" href="../../">Naar beginscherm</a>
    <button class="btn orange" onclick="leerlingnummer(-1)" value="volgende">Vorige</button>
    <button class="btn yellow" onclick="leerlingnummer(1)" value="volgende">Volgende</button>
</div>

<script>
function createCookie(name,value) {
    var expires = "";
    document.cookie = name+"="+value;
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}

function leerlingnummer(x){
    if (readCookie("Leerlingnum") != null) {
    //er is een leerlingnummer
        var leerlingnum = parseInt(readCookie("Leerlingnum"));
        leerlingnum = leerlingnum + x;
        if (leerlingnum <= (arrayRobin.length/2)) {
          if(leerlingnum >= 0){
              eraseCookie("Leerlingnum");
              createCookie("Leerlingnum", leerlingnum);
              window.location = self.location;
          }
        }
    } else {
        createCookie("Leerlingnum", 0);
        window.location = self.location;
    }
}
</script>

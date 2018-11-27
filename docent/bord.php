<!DOCTYPE html>
<html lang="nl">
<head>
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
    <script>
    $( document ).ready(function() {
        console.log( "ready!" );
        list();
    });
    </script>
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

include_once('../conn.php');

function codetaken($code){ //cheks if code is already taken
    $sql = "SELECT ";
}


if (!isset($_COOKIE['klas'])) {
    $nowValue = 1;
    $code = generateRandomString(5);
    setcookie('klas', $nowValue, time() + 7200, "/");
    setcookie('code', $code, time() + 72000, "/");
} else {
    $nowValue = $_COOKIE['klas'] + 1;
    setcookie('klas', $nowValue, time() + 7200, "/");
    $code = $_COOKIE['code'];
}

    $sql = "INSERT INTO tickets (ticket, naam, klas) VALUES (0, 'Started', '$code')";

    if ($conn->query($sql)) {

        if (isset($_POST['terug'])) {
            $nowValue = $nowValue - 1;
        }

        $sql = "SELECT naam, ticket FROM tickets WHERE ticket = '$nowValue' AND klas = '$code'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                setcookie('klas', $nowValue, time() + 7200, "/");
            }
        } else {
            $nowValue -= 1;
            setcookie('klas', $nowValue, time() + 7200, "/");
        }
        $sql = "SELECT naam, ticket FROM tickets WHERE ticket = '$nowValue' AND klas = '$code'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $name = $row['naam'];
                }
            }
    } else {
        echo "Houston, we got a problem";
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
            <input id="refresh" class="btn yellow" type="button" value="Volgende" onClick="window.location.reload()" style="margin: 0px; font-size: 1 em; padding: .8em 2em .8em 2em;">
        </section>
   </div>
  </div>
</div>
<div id="" style="overflow:auto;padding-top:5em; height:20em;">
<section class="container">

<div class="list-item">
    <div class="item-content">
    <span class="order">1</span> Alpha
    <a class="btn red" style="float: right; height: 2.5em; line-height: 1.25em;">X</a>
    </div>
</div>

<div class="list-item">
    <div class="item-content">
    <span class="order">2</span> Bravo
    <a class='btn red' style="float: right; height: 2.5em; line-height: 1.25em;">X</a>
    </div>
</div>

<div class="list-item">
    <div class="item-content">
    <span class="order">3</span> Charlie
    <a class="btn red" style="float: right; height: 2.5em; line-height: 1.25em;">X</a>
    </div>
</div>

<div class="list-item">
    <div class="item-content">
    <span class="order">4</span> Delta
    <a class="btn red" style="float: right; height: 2.5em; line-height: 1.25em;">X</a>
    </div>
</div>

<div class="list-item">
    <div class="item-content">
    <span class="order">5</span> Beta
    <a class="btn red" style="float: right; height: 2.5em; line-height: 1.25em;">X</a>
    </div>
</div>

<div class="list-item">
    <div class="item-content">
    <span class="order">6</span> Alpha
    <a class="btn red" style="float: right; height: 2.5em; line-height: 1.25em;">X</a>
    </div>
</div>

</section>
</div>
<div class="center">
    <form action="bord.php" method="post"><input type="submit" class="btn red" name="terug" value="Terug"></form>
    <a class="btn red" href="../">Terug</a>
    <input id="refresh" class="btn yellow" type="button" value="Volgende" onClick="window.location.reload()">
</div>

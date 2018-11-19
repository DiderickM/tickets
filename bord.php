<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tickets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="main.css">
    <link type="text/css" rel="stylesheet" href="tickets.css">
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
    if (isset($_POST['terug'])) {
        $nowValue -= 1;
    } else {
        $nowValue = $_COOKIE['klas'] + 1;
    }
    setcookie('klas', $nowValue, time() + 7200, "/");
    $code = $_COOKIE['code'];
}

    $sql = "INSERT INTO tickets (ticket, naam, klas) VALUES (0, 'Started', '$code')";

    if ($conn->query($sql)) {

        $sql = "SELECT naam, ticket FROM tickets WHERE ticket = '$nowValue' AND klas = '$code'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                setcookie('klas', $nowValue, time() + 300, "/");
            }
        } else {
            $nowValue -= 1;
            setcookie('klas', $nowValue, time() + 300, "/");
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
<div class="center">
    <form action="bord.php" method="post"><input type="submit" class="btn red" name="terug" value="Terug"></form>
    <input id="refresh" class="btn yellow" type="button" value="Volgende" onClick="window.location.reload()">
</div>
<script>
    var html = document.getElementsByTagName('html')[0];
    html.style.WebkitTransition = "all 2s";
    
    html.animate(html.style.cssText = "--main-bg-color: purple";);
</script>
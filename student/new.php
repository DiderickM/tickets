<!DOCTYPE html>
<html lang="nl">
<head>
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
    <link type="text/css" rel="stylesheet" href="../css/rainbow.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
</head>
<body style="margin: 0;">
<?php

include_once('../conn.php');

if (isset($_COOKIE['value'])) {
    echo '<center><h1 class="wrapper title">Je bent nummer ' . $_COOKIE['value'] . '!</h1></center>';
} else {
    if (isset($_POST['code']) && isset($_POST['naam'])) {
        $code = $_POST['code'];
        $naam = $_POST['naam'];
        if (isset($_POST['remember'])) {
            setcookie("username", $naam, time() + 2592000, "/");
        }

        $sql = "SELECT ticket FROM tickets WHERE klas = '$code' ORDER BY ticket DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $max = $row['ticket'] + 1;
                $datum = date("Y-m-d h:i:sa");
                $sql = "INSERT INTO tickets (ticket, naam, klas, datum) VALUES ('$max', '$naam', '$code', '$datum')";

                $cookie_name = "value";
                $cookie_value = $max;
                setcookie($cookie_name, $cookie_value, time() + (300), "/");

                echo '<center><h1 class="wrapper title">Je bent nummer ' . $max . '!</h1></center>';

                if ($conn->query($sql)) {
                } else {
                    echo "Houston, we got a problem";
                }
            }
        } else {
            echo '<style>center{color:white; font-size: 2em}</style>';
            echo '<center class="wrapper">Sorry, deze klas lijkt niet te bestaan man. Vet-balen.</center>';
        }
    }
}

echo '<a href="https://www.youtube.com/watch?v=lXMskKTw3Bc"><img src="banner.png" class="ads"></a>';

?>

</body>
</html>

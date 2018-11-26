<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tickets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="../css/main.css">
    <link type="text/css" rel="stylesheet" href="../css/tickets.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/utils/Draggable.min.js"></script>
    <script stc="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/TweenMax.min.js"></script>
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
<section class="container">

<div class="list-item">
    <div class="item-content">
    <span class="order">1</span> Alpha
    </div>
</div>

<div class="list-item">
    <div class="item-content">
    <span class="order">2</span> Bravo
    </div>
</div>

<div class="list-item">
    <div class="item-content">
    <span class="order">3</span> Charlie
    </div>
</div>

<div class="list-item">
    <div class="item-content">
    <span class="order">4</span> Delta
    </div>
</div>

</section>
<div class="center">
    <form action="bord.php" method="post"><input type="submit" class="btn red" name="terug" value="Terug"></form>
    <input id="refresh" class="btn yellow" type="button" value="Volgende" onClick="window.location.reload()">
</div>
<script>
    var html = document.getElementsByTagName('html')[0];
    html.style.WebkitTransition = "all 2s";
    
    html.animate(html.style.cssText = "--main-bg-color: purple";);
</script>
<script>

var rowSize = 100; // => container height / number of items
var container = document.querySelector(".container");
var listItems = Array.from(document.querySelectorAll(".list-item")); // Array of elements
var sortables = listItems.map(Sortable); // Array of sortables
var total = sortables.length;

TweenLite.to(container, 0.5, { autoAlpha: 1 });

function changeIndex(item, to) {

  // Change position in array
  arrayMove(sortables, item.index, to);

  // Change element's position in DOM. Not always necessary. Just showing how.
  if (to === total - 1) {
    container.appendChild(item.element);
  } else {
    var i = item.index > to ? to : to + 1;
    container.insertBefore(item.element, container.children[i]);
  }

  // Set index for each sortable
  sortables.forEach(function (sortable, index) {return sortable.setIndex(index);});
}

function Sortable(element, index) {

  var content = element.querySelector(".item-content");
  var order = element.querySelector(".order");

  var animation = TweenLite.to(content, 0.3, {
    boxShadow: "rgba(0,0,0,0.2) 0px 16px 32px 0px",
    force3D: true,
    scale: 1.1,
    paused: true });


  var dragger = new Draggable(element, {
    onDragStart: downAction,
    onRelease: upAction,
    onDrag: dragAction,
    cursor: "inherit",
    type: "y" });


  // Public properties and methods
  var sortable = {
    dragger: dragger,
    element: element,
    index: index,
    setIndex: setIndex };


  TweenLite.set(element, { y: index * rowSize });

  function setIndex(index) {

    sortable.index = index;
    order.textContent = index + 1;

    // Don't layout if you're dragging
    if (!dragger.isDragging) layout();
  }

  function downAction() {
    animation.play();
    this.update();
  }

  function dragAction() {

    // Calculate the current index based on element's position
    var index = clamp(Math.round(this.y / rowSize), 0, total - 1);

    if (index !== sortable.index) {
      changeIndex(sortable, index);
    }
  }

  function upAction() {
    animation.reverse();
    layout();
  }

  function layout() {
    TweenLite.to(element, 0.3, { y: sortable.index * rowSize });
  }

  return sortable;
}

// Changes an elements's position in array
function arrayMove(array, from, to) {
  array.splice(to, 0, array.splice(from, 1)[0]);
}

// Clamps a value to a min/max
function clamp(value, a, b) {
  return value < a ? a : value > b ? b : value;
}
</script>
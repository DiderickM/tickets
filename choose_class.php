<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tickets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
</head>
<style>
    
</style>

<body>
    <div class="center">
        <form action="new.php" method="post">
            <!--<input type="text" name="code" placeholder="C0D3!"><br>-->
            <div class="pos input-effect">
                <input name="code" class="input effect" type="text" placeholder="">
                <label>Klas code</label>
                <span class="focus-border"></span>
            </div>

            <!--<input type="text" name="naam" placeholder="Johan"><br>-->

            <div class="pos input-effect">
                <input name="naam" class="input effect" type="text" placeholder="">
                <label>Naam</label>
                <span class="focus-border"></span>
            </div>
            <div class="btncenter">
                <input style="width: 100%" class="btn blue" type="submit" value="Join!"><br>
                <a href="index.html" class="btn red">Terug</a>
            </div>
        </form>
    </div>
</body>
</html>
<script>
     
    $(window).load(function(){
       
		$("pos input").val("");
		
		$(".input-effect input").focusout(function(){
			if($(this).val() != ""){
				$(this).addClass("has-content");
			}else{
				$(this).removeClass("has-content");
			}
		})
	});
</script>
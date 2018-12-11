<!DOCTYPE html>
<html>

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
                <input id="input" name="code" class="input effect" type="text" placeholder="">
                <label>Klas code</label>
                <span class="focus-border"></span>
            </div>

            <!--<input type="text" name="naam" placeholder="Johan"><br>-->

            <div class="pos input-effect">
                <input id="input2" name="naam" class="input effect" type="text" placeholder="">
                <label>Naam</label>
                <span class="focus-border"></span>
            </div>
            <div class="btncenter">
                <input style="width: 100%" class="btn blue" type="submit" value="Join!"><br>
                <a href="../" class="btn red">Terug</a>
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

        var myInput1 = document.getElementById("input");
        if (myInput1 && myInput1.value) {
            
            $('#input').addClass("has-content");
            
        }

        var myInput2 = document.getElementById("input2");
        if (myInput2 && myInput2.value) {
            $('#input2').addClass("has-content");
        }

	});
</script>
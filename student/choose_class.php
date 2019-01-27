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
    <!-- emoji -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/css/emoji.css" rel="stylesheet">
    <!-- end emoji -->
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

            <div class="pos input-effect">
                <input data-emojiable="true" data-emoji-input="unicode" id="input2" name="naam" class="input effect" type="text" placeholder="" maxlength="15">
                <label>Naam</label>
                <span class="focus-border"></span>
            </div>

            <div class="btncenter">
                <input style="width: 100%" class="btn blue" type="submit" value="Join!"><br>
                <a href="../" class="btn red">Terug</a>
            </div>
        </form>
    </div>
      <!-- ** Don't forget to Add jQuery here ** -->
  <script src="lib/js/config.js"></script>
  <script src="lib/js/util.js"></script>
  <script src="lib/js/jquery.emojiarea.js"></script>
  <script src="lib/js/emoji-picker.js"></script>

  
  <script>
      $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: 'lib/img/',
          popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
      });
    </script>
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
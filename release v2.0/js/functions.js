$( ).ready(function() {
    //global
    oldArray = [];
    arrayRobin = [];
    //hier houdt global op

    //we hebben het bestand geladen
    console.log( "ready!" );

    //krijg de data van een cookie als je de naam opgeef
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

    var nummerNu = readCookie("value");

    //deze functie bepaalt wat er met de ingekomen data gebeurt
    function processData(data){
        console.log(data);
        //als de nieuwe array langer is dat betekent dat er meer data in staat en dus moet hij updaten
        if(data.length != oldArray.length){
            console.log("er is nieuwe data");
            console.log(data);
            displayList(data);
            oldArray = data;
            return true;
        }else{
            //geen update van data nodig
            console.log("er is geen nieuwe data")
            console.log(data);
            return false;
        }
    }

//de array wordt ingevoerd wordt ingevoerd in de DOM
function displayList(data) {

    //chek of array deelbaar is door twee, als het niet zo is dat betekent dat er iets mis is gegaan
    if(data.length != 0){
        if(data.length % 2){
            console.log("JE HEBT EEN VERKEERDE ARRAY");
            console.log(data);
            loadData();
            return false;
        }else{
            var list = document.getElementById('myList');
            while (list.firstChild) {
                list.removeChild(list.firstChild);
            }
            for (var i = 0; i < data.length; i = i + 2) {
                var nummer = data[i]
                var naam = data[i + 1];
                if (nummer >= nummerNu) {
                  console.log("Nummer :" +  nummer + "Naam :" + naam);
                  var entry = document.createElement("div");
                  entry.setAttribute('class', 'list-item');

                  var entryTwo = document.createElement("div");
                  entryTwo.setAttribute('class', 'item-content');

                  var entryThree = document.createElement("span");
                  entryThree.setAttribute('class', 'order');
                  entryThree.appendChild(document.createTextNode(nummer));

                  var text = document.createTextNode("    " + naam);

                  entryTwo.appendChild(entryThree);
                  entryTwo.appendChild(text);
                  entry.appendChild(entryTwo);
                  list.appendChild(entry);
                }
            }
        }
    }
        return true;
}

//ajax haal data op
function loadData(){
        var klasCode = readCookie('code');
                $.ajax({
                    type: "GET",
                    url: "getvalue.php",
                    data: "code="+klasCode,
                    cache: false,
                    success: function(data){
                        var data = data.split(',');
                        arrayRobin = data;
                        //verwijs naar de functie processData deze besluit wat er met de data gebeurt
                        if(processData(data)){
                            //de functies in processData hebben elementen gemaakt, maar deze moeten nog visueel worden verwerkt
                            list();
                        };
                    }
                });
            x = 3;
            setTimeout(loadData, x*1000);
}



//eerste keer aanroepen om de functie laten te beginnen
loadData(); // execute function
});

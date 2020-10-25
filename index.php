<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <!--Icons made by photo3idea_studio from www.flaticon.com-->
    <link rel="icon" href="icon/taxiviewer.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/taxi.js"></script>
    <script>
        var initialCreation = false;
        var colorArray;
        var LatestSelectedColor;
        var selectedHex;
        //makes a request every second
        window.setInterval(() => {
            var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                colorArray = JSON.parse(this.responseText);
                
                LatestSelectedColor = colorArray["selectedColors"][(colorArray["selectedColors"].length)-1];
                colorArray["colors"].forEach(color => {
                    //grabs the latest selected color hex
                    if(color.name == LatestSelectedColor) {
                        selectedHex = color.color;
                    }
                });
                
                //sets displayText.innerText to be last element of selectedColors
                if(colorArray["selectedColors"].length != 0) {
                    document.getElementById("displayText").innerHTML = LatestSelectedColor;
                    
                    document.getElementById("colorDisplay").style["background-color"] = selectedHex;
                }
                else{
                    
                    document.getElementById("colorDisplay").style["background-color"] = "white";
                    document.getElementById("displayText").innerHTML = "Loading...";
                }
                if(initialCreation == false) {
                    CreateColorGrid(colorArray);
                    initialCreation = true;
                }
                //updates selected color by parsing colors array and selected colors array
                updateSelectedColor(colorArray['colors'],colorArray['selectedColors']);
                
            }
        };
        xmlhttp.open("GET", "controller/taxis.php?q=getArray", true);
        xmlhttp.send();
        }, 1000);
        
    </script>
    <title>Taxi Viewer</title>
</head>
<script>
</script>
<body>
    <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="https://web1.stedmunds.nsw.edu.au/common/content/images/logos/SEC_NoBg_NoName_64x64.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy"> St Edmund's College Taxi Viewer
            </a>
    </nav>

    <div class="container-sm float-right" id="colorDisplay" style="width:50%;height:100vh;padding:200px;">
    <h1 class="text-center" id="displayText" style="background-color:white;">Loading...</h1>
    </div>
    <div class="container-sm float-left" id="colorCardContainer" style="width:50%;">
    
    </div>
</body>
</html>
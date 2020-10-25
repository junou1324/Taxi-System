<?php include 'taxis.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css?v=<?php echo md5_file("../css/bootstrap.css");?>">
    <!--Icons made by itim2101 from www.flaticon.com-->
    <link rel="icon" href="../icons/taxi__controller.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/taxi.js?v=<?php echo md5_file("../js/taxi.js");?>"></script>
    <script src="../js/bootstrap.js?v=<?php echo md5_file("../js/bootstrap.js");?>"></script>
    <title>Taxi Controller</title>
    
</head>

<body>
    <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="https://web1.stedmunds.nsw.edu.au/common/content/images/logos/SEC_NoBg_NoName_64x64.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy"> St Edmund's College Taxi Controller
            </a>
    </nav>
    <div class="container-sm float-right" id="colorDisplay" style="width:50%;height:100vh;padding:200px;">
    <h1 class="text-center" id="displayText" style="background-color:white;"></h1>
    </div>
    <div class="container-sm float-left" style="background-color: beige;width:50%">
    <form method="post" id="loginForm">
    <?php 
    //Load the file
    $data = file_get_contents("../data/data.json");
    //Decode the JSON data into a PHP array.
    $data = json_decode($data,false);
    $count = 0;
    //get selected colors from json
    $selectedColors = $data->selectedColors;

    //Looks for button inputs from $_POST to see if it contains colors
    foreach($data->{'colors'} as $color)
    {
        $colorName = $color->{'name'};
        $colorHex = $color->{'color'};
        if(in_array($colorName,$_POST))
        {
            if(isset($_POST[$colorName])){
                if(!empty($_POST[$colorName])) {
                    addSelectedColor($colorName,$colorHex);
                    }
            }
        }
            if(isset($_POST[$colorName."-disabled"])){
                if(!empty($_POST[$colorName."-disabled"]))
                {
                    removeSelectedColor($colorName);
                }
            }
    }
    //calls resetSelection to clear selected colors from JSON
    if (isset($_POST["reset"])) {
        if (!empty($_POST["reset"])) {
            resetSelections();
        }
    }


    foreach($data->{'colors'} as $color)
    {   
        //wraps each column in row div
        if(($count % 3) == 0 and $count != 0)
        {
            echo "</div>";
            echo "<div class='row'>";
        }
        elseif($count == 0){
            echo "<div class='row'>";
        }
        $colorName = $color->{'name'};
        $colorHax = $color->{'color'};
        //checks if current color to see if it's been already selected
        $exist = in_array($colorName,$selectedColors);
        if($exist == false){
            echo "<div class='col-sm'><input name='".$colorName."' id='".$colorName."' class='btn btn-light btn-lg btn-block' type='submit' value='".$colorName."' style='background-color:".$colorHax."'></div>";
        }
        else{
            //disable button if it has been selected
            //changing opacity rather than disable
            echo "<div class='col-sm'><input name='".$colorName."-disabled' id='".$colorName."' class='btn btn-light btn-lg btn-block' type='submit' value='".$colorName."' style='opacity:0.5;text-decoration:line-through;background-color:".$colorHax."'></div>";
        }
        $count++;
    }

    ?>
    <input class='btn btn-dark btn-lg btn-block' type='submit' name="reset" value="Reset">
    </form>
    </div>
</body>
</html>
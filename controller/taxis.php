<?php
    //Load the file
    $data = file_get_contents("../data/data.json");
    //Decode the JSON data into a PHP array.
    //check request from viewer and parse array
    $q = $_REQUEST["q"];
    if($q == "getArray")
    {
        echo $data;
    }
function resetSelections() {
    //Load the file
    $tempData = file_get_contents("../data/data.json");
    //Decode the JSON data into a PHP array.
    $tempData = json_decode($tempData,true);
    //GET number of colors
    $numberOfInputButtons = count($tempData['colors']);
    $tempData['selectedColors'] = [];
    $json_object = json_encode($tempData);
    echo "<script type='text/javascript'>resetInputButtons(".$numberOfInputButtons.",".$json_object.")</script>";
    file_put_contents("../data/data.json",$json_object);

    }

    function addSelectedColor($selectedColor,$selectedHex){

        //Load the file
        $tempData = file_get_contents("../data/data.json");
        //Decode the JSON data into a PHP array.
        $tempData = json_decode($tempData,true);
        if(!in_array($selectedColor,$tempData['selectedColors']))
        {
            array_push($tempData['selectedColors'],$selectedColor);
            $json_object = json_encode($tempData);
            file_put_contents("../data/data.json",$json_object);
        }else{echo $selectedColor." is already in the selected colors array";}

        //echo "<script>document.addEventListener('DOMContentLoaded', function(event) {document.getElementById('".$selectedColor."').disabled = 1;document.getElementById('".$selectedColor."').style['text-decoration'] = 'line-through';});</script>";
        echo "<script type='text/javascript'>ColorSelectedAction('".$selectedColor."','".$selectedHex."')</script>";
    }

    function removeSelectedColor($selectedColor) {
        //Load the file
        $tempData = file_get_contents("../data/data.json");
        //Decode the JSON data into a PHP array.
        $tempData = json_decode($tempData,true);
        if(in_array($selectedColor,$tempData['selectedColors']))
        {
            $selectedColorIndex = array_search($selectedColor,$tempData["selectedColors"]);
            //unset($tempData["selectedColors"][$selectedColorIndex]);
            array_splice($tempData['selectedColors'],$selectedColorIndex,1);
            $json_object = json_encode($tempData,false);
            file_put_contents("../data/data.json",$json_object);
        }else{echo $selectedColor." has not been selected";}
        echo "<script type='text/javascript'>ColorRemovedAction('".$selectedColor."')</script>";
    }
?>
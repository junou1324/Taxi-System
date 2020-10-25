//---------------Controller Functions-----------------------//
function resetInputButtons(numberOfInputButtons, colorArray) {
    document.addEventListener('DOMContentLoaded', function(event) {
        var i;
        for (i = 0; i < numberOfInputButtons; i++) {
            document.getElementsByTagName("input")[i].style['opacity'] = '1';
            document.getElementsByTagName("input")[i].style['text-decoration'] = 'none';
        }
        //loop through all buttons and change button name to not include -disabled
        colorArray['colors'].forEach(resetButtonName);
    });
}

function resetButtonName(color) {
    document.getElementById(color.name).setAttribute('name', color.name);
}

function ColorSelectedAction(selectedColor, selectedHex) {
    document.addEventListener('DOMContentLoaded', function(event) {
        document.getElementById(selectedColor).style['opacity'] = '0.5';
        document.getElementById(selectedColor).style['text-decoration'] = 'line-through';
        document.getElementById(selectedColor).setAttribute('name', selectedColor + "-disabled");
        document.getElementById("colorDisplay").style["background-color"] = selectedHex;
        document.getElementById("displayText").textContent = selectedColor;
    });
}

function ColorRemovedAction(selectedColor) {
    document.addEventListener('DOMContentLoaded', function(event) {
        document.getElementById(selectedColor).style['opacity'] = '1';
        document.getElementById(selectedColor).style['text-decoration'] = 'none';
        document.getElementById(selectedColor).setAttribute('name', selectedColor);
    });
}
//----------------Viewer functions------------------------->
//creates the color cards
function CreateColorGrid(colorArray) {
    //-------------------------------------------//
    var body = document.getElementsByTagName("body")[0];
    const colorCardContainer = document.getElementById("colorCardContainer");
    //counter for array index
    var upto = 0;
    for (var i = 0; i < (colorArray['colors'].length / 3); i++) {
        var rowDiv = document.createElement("div");
        rowDiv.className = "row";
        for (var j = 0; j < 3; j++) {
            var colorDiv = document.createElement("div");
            colorDiv.className = "card";
            colorDiv.id = colorArray['colors'][upto].name;
            colorDiv.style['background-color'] = colorArray['colors'][upto].color;
            colorDiv.style['width'] = "auto";
            colorDiv.style['margin-right'] = "0";
            colorDiv.style['padding'] = "10px";
            colorDiv.style['text-align'] = "center";
            const text = document.createTextNode(colorArray['colors'][upto].name);
            colorDiv.appendChild(text);
            //creates column div
            const colDiv = document.createElement("div");
            colDiv.className = "col-sm";
            colDiv.style['padding'] = "10px";
            //appends colorDiv to the column
            colDiv.appendChild(colorDiv);
            rowDiv.appendChild(colDiv);
            //incredent up to so it iterates through all colors
            upto++;
        }
        colorCardContainer.appendChild(rowDiv);
    }
    body.appendChild(colorCardContainer);
}
//when color exists in selected color then change select color's color card
function updateSelectedColor(colorArray, selectedArray) {

    colorArray.forEach(color => {
        //grabs the latest selected color hex
        if (selectedArray.includes(color.name)) {
            document.getElementById(color.name).style['text-decoration'] = "line-through";
            document.getElementById(color.name).style['opacity'] = '0.5';
        } else {
            document.getElementById(color.name).style['text-decoration'] = "none";
            document.getElementById(color.name).style['opacity'] = '1';
        }
    });
}
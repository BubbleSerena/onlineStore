
//Javascript to map the images to the screen coordinates
function displayCategories(arg) {
    document.getElementById('pic').src = arg.concat(".png");
    document.getElementById('pic').useMap = "#".concat(arg);
}

//Javascript to only display Categories
function closeCategories(){
    displayCategories("Images/Categories");
}

function validate(){
    if(document. getElementById("quantity").value == " "){
        alert("Please enter the quantity");
        return false;
    }
    if(document.getElementById("quantity").value > 200 || document.getElementById('amount').value <= 0){
        alert("Please enter realistic quantities");
        return false;
    }
    return true;
}


var menuItems = document.getElementById("menuItems");
menuItems.style.maxHeight = "0px";

function menutoggle(){
    if(menuItems.style.maxHeight == "0px"){

        menuItems.style.maxHeight = "200px";

    }
    else{
        menuItems.style.maxHeight = "0px"
    }
}

// js for product gallery

var productImg = document.getElementById("productImg");
var smallImg = document.getElementsByClassName("small-img");

smallImg[0].onclick = function()
{
    productImg.src = smallImg[0].src;
}

smallImg[1].onclick = function()
{
    productImg.src = smallImg[1].src;
}

smallImg[2].onclick = function()
{
    productImg.src = smallImg[2].src;
}

smallImg[3].onclick = function()
{
    productImg.src = smallImg[3].src;
}

// js for toggle Form



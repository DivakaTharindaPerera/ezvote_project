

var hamburger = document.querySelector(".hamburger");
hamburger.addEventListener("click", function(){
    document.querySelector("body").classList.toggle("active");
})

function closeNav() {
    document.getElementById("sidebar").style.width = "0";
    document.getElementById("row").style.marginLeft= "0";
  }
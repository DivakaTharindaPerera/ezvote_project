function openPopup(){
    let popup=document.getElementById("popup");
    popup.classList.add("open-popup");
}
function closePopup()
{
    console.log("close");
    let popup=document.getElementById("popup");
    popup.classList.remove("open-popup");
    // window.location.href = "/Voters/election";
}
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

document.getElementById("continue").addEventListener("click", function(){
    window.location.href = "<?php echo urlroot; ?>/Candidate/viewElections.php";
  });

  

/************************************************* */  
// function onlyOne(checkbox) {
//     var checkboxes = document.getElementsByName('check')
//     checkboxes.forEach((item) => {
//         if (item !== checkbox) item.checked = false
//     })
// }

const new_party=document.getElementById("new_party");
const exist_party =document.getElementById("existing_party")

const existing_party=document.getElementById("existing_party")
new_party.addEventListener("change",()=>{
    if(new_party.checked==true){
        for(i=0;i<existing_party.length;i++){
            existing_party[i].disabled=true;
        }
    }else{
        for(i=0;i<existing_party.length;i++){
            existing_party[i].disabled=false;
        }
    }
})

const new_parties=document.getElementById("new_party")
exist_party.addEventListener("change",()=>{
    if(exist_party.checked==true){
        for(i=0;i<new_parties.length;i++){
            new_parties[i].disabled=true;
        }
    }else{
        for(i=0;i<new_parties.length;i++){
            new_parties[i].disabled=false;
        }
    }
})
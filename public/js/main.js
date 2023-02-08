function openPopup(){
    let popup=document.getElementById("popup");
    popup.classList.add("open-popup");
}
function closePopup()
{
    // console.log("close");
    let popup=document.getElementById("popup");
    popup.classList.remove("open-popup");
    // window.location.href = "/Voters/election";
}


function vote(){
    // document.location.href="/ezvote/app/View/Voter/votingBallot.php";
    window.location.href="/ezvote/Voters/vote";
}

function marked(id){
    const elem = document.getElementById(id);
    const div = document.getElementById('card-' + id);
    // div.classList.toggle('hidden');
    // document.getElementById("card").disable();
}

function accepted(){
    const rules=document.getElementById("rules");
    const content=document.getElementById("content");
    if(rules.checked){
        content.style.display="flex";
        // console.log("checked");
    }
    else {
        content.style.display="none";
    }
}

function cancelBallot(){
    window.location.href="/ezvote/Voters/vote";
}
function confirmBallot(){
    window.location.href="/ezvote/Voters/election";
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


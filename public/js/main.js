function openPopup(){
    let popup=document.getElementById("popup");
    popup.classList.add("open-popup");
}
function closePopup()
{
    // console.log("close");
    // let popup=document.getElementById("popup");
    // popup.classList.remove("open-popup");
    window.location.href = "/Voters/election";
}

function vote(){
    // document.location.href="/ezvote/app/View/Voter/votingBallot.php";
    window.location.href="/ezvote/Voters/vote";
}

function marked(){
    document.getElementById("card").disable();
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
function openPopup(id=null){
    if(id!=null){
        console.log(id);
        const form=document.getElementById("objection_form");
        const candidate_id=document.getElementById("CandidateID");
        candidate_id.value=id;
    }
    let popup=document.getElementById("popup");
    popup.classList.add("open-popup");
}
function closePopup()
{
    // console.log("close");
    const button=document.getElementById("close");
    event.preventDefault();
    let popup=document.getElementById("popup");
    popup.classList.remove("open-popup");
    // window.location.href = "/Voters/election";
}


function vote($election_id){
    const election_id=$election_id;
    window.location.href="/ezvote/Voters/vote/"+election_id;
}

function viewElection($election_id){
    const election_id=$election_id;
    window.location.href="/ezvote/Voters/election/"+election_id;
}

function viewObjections($candidate_id,$election_id){
    const candidate_id=$candidate_id;
    const election_id=$election_id;
    window.location.href="/ezvote/Voters/viewObjections/"+candidate_id+"/"+election_id;
}
function viewSummary($election_id){
    const election_id=$election_id;
    // document.location.href="/ezvote/app/View/Voter/votingBallot.php";
    window.location.href="/ezvote/Voters/summary/"+election_id;
}

function marked(id){
    const div = document.getElementById('card-' + id);
    console.log(div);
    // let button_state;
    const cardParent=div.parentElement;
    console.log(cardParent);
    cardParent.classList.toggle('marked');
    for (i=1;i<=cardParent.childElementCount;i++){
        console.log(i);
        if(cardParent.children[i-1].id=='card-'+id){
            if (cardParent.children[i-1].classList.contains('marked')) {
                const button = cardParent.children[i - 1].getElementsByTagName('button')[0];
                button.addEventListener('click', () => {
                    console.log('hello');
                });
                button.disabled = false;
            }
            else{
                const button = cardParent.children[i - 1].getElementsByTagName('button')[0];
                button.removeEventListener('click')
                button.disabled = true;
            }
            continue;
        }
        else{
            if (cardParent.children[i-1].classList.contains('marked')) {
                const button = cardParent.children[i - 1].getElementsByTagName('button')[0];
                button.addEventListener('click', () => {
                    console.log('hello');
                });
                button.disabled = false;
            }
            else{
                const button = cardParent.children[i - 1].getElementsByTagName('button')[0];
                button.removeEventListener('click')
                button.disabled = true;
            }
            //     const div1 = cardParent.children[i-1];
            //     console.log(i-1)
            // const button=div1.getElementsByTagName('button')[0];
            // button.removeEventListener('click')
            // button.disabled=true;

        }
    }
}

// function accepted(){
//     const rules=document.getElementById("rules");
//     const content=document.getElementById("content");
//     if(rules.checked){
//         content.style.display="flex";
//         // console.log("checked");
//     }
//     else {
//         content.style.display="none";
//     }
// }

function cancelBallot(id){
    window.location.href="/ezvote/Voters/vote/"+id;
}
function confirmBallot(){
    window.location.href="/ezvote/Pages/dashboard";
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


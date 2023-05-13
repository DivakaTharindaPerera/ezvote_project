function ongoing_summary(election_id){
    window.location.href="/ezvote/pages/viewOngoingElection/"+election_id;
}
function ongoing_summaryForSupervisor(election_id){
    window.location.href="/ezvote/votings/inspectMyElection/"+election_id;
}
function viewSummaryForSupervisor(election_id){
    window.location.href="/ezvote/pages/viewCompletedElection/"+election_id;
}

function viewSummaryRestricted(){
    console.log("viewSummaryRestricted");
    let popup=document.getElementById("popup");
    popup.classList.add("open-popup");
    // window.location.href="/ezvote/pages/viewCompletedElectionRestricted/"+election_id;
}
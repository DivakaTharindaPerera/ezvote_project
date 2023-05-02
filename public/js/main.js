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

function marked(id,candidate_id){
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
    // console.log('hello');
    // window.location.href="/ezvote/Voters/temporaryVotes/"+candidate_id;
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

// ************************************** discussion.js ********************************************************************


var myVar = setInterval(LoadData, 2000); // setInterval() method calls a function at specified intervals (in milliseconds)

http_request = new XMLHttpRequest();

function LoadData(){
$.ajax({
url: '<?php echo urlroot; ?>/app/Model/discussion.php',
type: "POST",
dataType: 'json',
success: function(data) {
    $('#MyTable tbody').empty();
    for (var i=0; i<data.length; i++) {
        var commentId = data[i].id;
        if(data[i].parent_comment == 0){
        var row = $('<tr><td><b><img src="avatar.jpg" width="30px" height="30px" />' + data[i].student + ' :<i> '+ data[i].date + ':</i></b></br><p style="padding-left:80px">' + data[i].post + '</br><a data-toggle="modal" data-id="'+ commentId +'" title="Add this item" class="open-ReplyModal" href="#ReplyModal">Reply</a>'+'</p></td></tr>');
        $('#record').append(row);
        for (var r = 0; (r < data.length); r++)
                {
                    if ( data[r].parent_comment == commentId)
                    {
                        var comments = $('<tr><td style="padding-left:80px"><b><img src="avatar.jpg" width="30px" height="30px" />' + data[r].student + ' :<i> ' + data[r].date + ':</i></b></br><p style="padding-left:40px">'+ data[r].post +'</p></td></tr>');
                        $('#record').append(comments);
                    }
                }
        }
    }
},
error: function(jqXHR, textStatus, errorThrown){
    alert('Error: ' + textStatus + ' - ' + errorThrown);
}
});
}



$(document).on("click", ".open-ReplyModal", function () {
     var commentid = $(this).data('id');
     $(".modal-body #commentid").val( commentid );
});


		
//Post data to the server
$(document).ready(function() {
	$('#butsave').on('click', function() {
		$("#butsave").attr("disabled", "disabled");
		var id = document.forms["frm"]["Pcommentid"].value;
		var name = document.forms["frm"]["name"].value;
		var msg = document.forms["frm"]["msg"].value;
		if(name!="" && msg!=""){
			$.ajax({
				url: "<?php echo urlroot; ?>/app/Model/discussion.php",
				type: "POST",
				data: {
					id: id,
					name: name,
					msg: msg,			
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$("#butsave").removeAttr("disabled");
						document.forms["frm"]["Pcommentid"].value = "";
						document.forms["frm"]["name"].value = "";
						document.forms["frm"]["msg"].value = "";
						LoadData(); 						
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
});

//Reply comment
$(document).ready(function() {
	$('#btnreply').on('click', function() {
		$("#btnreply").attr("disabled", "disabled");
		var id = document.forms["frm1"]["Rcommentid"].value;
		var name = document.forms["frm1"]["Rname"].value;
		var msg = document.forms["frm1"]["Rmsg"].value;
		if(name!="" && msg!=""){
			$.ajax({
				url: "<?php echo urlroot; ?>/app/Model/discussion.php",
				type: "POST",
				data: {
					id: id,
					name: name,
					msg: msg,			
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$("#btnreply").removeAttr("disabled");
						document.forms["frm1"]["Rcommentid"].value = "";
						document.forms["frm1"]["Rname"].value = "";
						document.forms["frm1"]["Rmsg"].value = "";
						LoadData(); 
						$("#ReplyModal").modal("hide");
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
});

function profile(){
    let popup=document.getElementById("popup2");
    popup.classList.add("open-popup");
}
function closeProfile(){
    let popup=document.getElementById("popup2");
    popup.classList.remove("open-popup");
}
function editingProfile(){
    window.location.href="/ezvote/pages/editProfile";
}
function savingDetails(){
    console.log("saving details")
    window.location.href="/ezvote/pages/editProfile";
}


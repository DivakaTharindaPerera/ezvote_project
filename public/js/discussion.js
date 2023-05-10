// ************************************** discussion.js ********************************************************************

// load the chat
let http_request = new XMLHttpRequest();
// fetch data from the server
LoadData();
function LoadData(){
	var profile_picture = $('#profile_picture').val();

// make an ajax call to the server
$.ajax({
// sets the url for the ajax request 	
url: '/ezvote/Candidates/viewPost',
type: "POST",
dataType: 'json', // data type of the response from server is json
success: function(data) { // callback function that is executed if the request succeeds
	// data =  JSON data returned by the server (array)
    console.log(data);
    $('#MyTable tbody').empty(); // empty the tbody element
    for (var i=0; i<data.length; i++) {
        var commentId = data[i].id; // id of the current element in the data array
        if(data[i].parent_comment == 0){ // parent_comment property of the current element of data array is 0
        var row = $('<tr class="comment"><td style="text-align:left;"><b><img src="' + profile_picture + '" width="30px" height="30px"/>' + data[i].student + ' :<i> '+ data[i].date + ':</i></b></br><p style="padding-left:80px">' + data[i].post + '</br><a data-toggle="modal" data-id="'+ commentId +'" title="Add this item" class="open-ReplyModal" href="#ReplyModal" onclick="openPopup()">Reply</a>'+'</p></td></tr>');
        $('#record').append(row);
        for (var r = 0; (r < data.length); r++)
                {
                    if ( data[r].parent_comment == commentId)
                    {
                        var comments = $('<tr class="comment"><td style="padding-left:0px"><b><img src="' + profile_picture + '" width="30px" height="30px" padding-left:80px;/>' + data[r].student + ' :<i> ' + data[r].date + ':</i></b></br><p style="padding-left:40px">'+ data[r].post +'</p></td></tr>');
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
	 console.log(commentid)
     $(".modal-body #commentid").val( commentid );
	 $("#ReplyModal").removeClass("none")
});


		
//create the question
$(document).ready(function() {
	$('#butsave').on('click', function() {
		$("#butsave").attr("disabled", "disabled");
		var id = document.forms["frm"]["Pcommentid"].value;
		var name = document.forms["frm"]["name"].value;
		var msg = document.forms["frm"]["msg"].value;
        // console.log(id);
        // console.log(name);
        // console.log(msg);
		if(name!="" && msg!=""){
			$.ajax({
				url: "/ezvote/Candidates/createPost",
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

// create the reply comment
$(document).ready(function() {
	$('#btnreply').on('click', function() {
		$("#btnreply").attr("disabled", "disabled");
		var id = document.forms["frm1"]["Rcommentid"].value;
		var name = document.forms["frm1"]["Rname"].value;
		var msg = document.forms["frm1"]["Rmsg"].value;
        console.log(id);
        console.log(name);
        console.log(msg);
       
		if(name!="" && msg!=""){
			$.ajax({
				url: "/ezvote/Candidates/createPost",
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
	
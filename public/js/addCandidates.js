var partyList = document.getElementById('partyListCandidate');
var primaryOption = document.createElement('option');
primaryOption.innerHTML = "No Party";
primaryOption.value = "0";
partyList.appendChild(primaryOption);
var positions = [];
var positionData = document.getElementById('positionData').value;
var positionMainDiv = document.getElementById('candidateList');

var positionData = positionData.split("|");
for (var i = 0; i < positionData.length - 1; i++) {
    var temp = positionData[i].split("-");
    positions.push(temp);
}
console.log(positions);
console.log(positions.length);



if (positions.length > 0) {
    for (var i = 0; i < positions.length; i++) {
        var positionDiv = document.createElement('div');
        positionDiv.id = positions[i][1];
        positionDiv.setAttribute('class', 'border-1 border-radius-2 p-1');
        var positionHead = document.createElement('h3');
        positionHead.innerHTML = positions[i][0];
        positionDiv.appendChild(positionHead);
        var brk = document.createElement('br');
        positionMainDiv.appendChild(positionDiv);
        positionMainDiv.appendChild(brk);

        var ctable = document.createElement('table');
        ctable.setAttribute('class', 'mt-1');
        ctable.border = "1";
        ctable.id = "candidateTable" + positions[i][1];
        ctable.style.visibility = "hidden";
        var cthead = document.createElement('thead');
        cthead.id = "candidateTableHead" + positions[i][1];
        var ctr = document.createElement('tr');
        var cth1 = document.createElement('th');
        cth1.innerHTML = "Candidate Name";
        var cth2 = document.createElement('th');
        cth2.innerHTML = "Candidate Email";
        var cth3 = document.createElement('th');
        cth3.innerHTML = "Candidate Party";
        var cth4 = document.createElement('th');
        cth4.innerHTML = "Action";

        ctr.appendChild(cth1);
        ctr.appendChild(cth2);
        ctr.appendChild(cth3);
        ctr.appendChild(cth4);

        cthead.appendChild(ctr);
        ctable.appendChild(cthead);

        var ctbody = document.createElement('tbody');
        ctbody.id = "candidateTableBody" + positions[i][1];
        ctable.appendChild(ctbody);
        positionDiv.appendChild(ctable);
    }
} else {
    var positionDiv = document.createElement('div');
    positionDiv.id = "0";
    var positionHead = document.createElement('h3');
    positionHead.innerHTML = "Candidates";
    positionDiv.appendChild(positionHead);
    var brk = document.createElement('br');
    positionMainDiv.appendChild(positionDiv);
    positionMainDiv.appendChild(brk);
}

var count = 0;
var parties = [];
var candidates = [];

function checkForPartyDuplicates(party) {
    if (parties.length == 0)
        return false;
    for (var i = 0; i < parties.length; i++) {
        if (parties[i][0] == party)
            return true;
    }
    return false;
}

function createParty() {
    document.getElementById('createParty').style.display = "block";
}

function addParty() {
    document.getElementById('partyNameError').innerHTML = "";
    document.getElementById('supNameError').innerHTML = "";
    document.getElementById('supEmailError').innerHTML = "";

    var name = document.getElementById('partyName')
    var supName = document.getElementById('partySupName')
    var supEmail = document.getElementById('partySupEmail')
    var tbody = document.getElementById('parties');

    if (name.value == "") {
        document.getElementById('partyNameError').innerHTML = "Party name is required";
        name.focus();
        return;
    }

    if (supName.value == "") {
        document.getElementById('supNameError').innerHTML = "Party supervisor name is required";
        supName.focus();
        return;
    }

    if (supEmail.value == "") {
        document.getElementById('supEmailError').innerHTML = "Party supervisor email is required";
        supEmail.focus();
        return;
    }

    if (checkForPartyDuplicates(name.value)) {
        document.getElementById('partyNameError').innerHTML = "Party already exists";
        name.focus();
        return;
    }



    var row = document.createElement('tr');
    var nameCell = document.createElement('td');
    var supNameCell = document.createElement('td');
    var supEmailCell = document.createElement('td');
    var action = document.createElement('td');
    var deleteBtn = document.createElement('button');

    nameCell.innerHTML = name.value;
    supNameCell.innerHTML = supName.value;
    supEmailCell.innerHTML = supEmail.value;

    parties.push([name.value, supName.value, supEmail.value]);

    deleteBtn.innerHTML = "Delete";
    deleteBtn.setAttribute('onclick', 'deleteParty(this)');
    deleteBtn.setAttribute('class', 'btn btn-danger card-hover');
    action.appendChild(deleteBtn);
    

    row.appendChild(nameCell);
    row.appendChild(supNameCell);
    row.appendChild(supEmailCell);
    row.appendChild(action);

    tbody.appendChild(row);

    count++;

    name.value = "";
    supName.value = "";
    supEmail.value = "";

    document.getElementById('createParty').style.display = "none";
    document.getElementById('partyTable').style.visibility = "visible";

    console.log(parties);
    console.log(count);

    //partyList for candidates

    // for(var i = 0; i <= partyList.length; i++){
    //     partyList.remove(0);
    // }
    partyList.innerHTML = "--Select a Party--";
    var primaryOption = document.createElement('option');
    primaryOption.innerHTML = "No Party";
    partyList.appendChild(primaryOption);

    for (var i = 0; i < parties.length; i++) {
        var option = document.createElement('option');
        option.innerHTML = parties[i][0];
        partyList.appendChild(option);
    }

}

function cancelAddParty() {
    document.getElementById('createParty').style.display = "none";
}

function deleteParty(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    count--;

    for (var i = 0; i < parties.length; i++) {
        if (parties[i][0] == row.childNodes[0].innerHTML) {
            parties.splice(i, 1);
        }
    }

    if (count == 0) {
        document.getElementById('partyTable').style.visibility = "hidden";
    }

    // for(var i = 0; i <= partyList.length; i++){
    //     partyList.remove(0);
    // }

    partyList.innerHTML = "--Select a Party--";
    var primaryOption = document.createElement('option');
    primaryOption.innerHTML = "No Party";
    partyList.appendChild(primaryOption);

    for (var i = 0; i < parties.length; i++) {
        var option = document.createElement('option');
        option.innerHTML = parties[i][0];
        partyList.appendChild(option);
    }

    console.log(parties);
    console.log(count);
}

function displayDiv() {
    if (document.getElementById('humanRadio').checked) {
        document.getElementById('humansDiv').style.display = "block";
        document.getElementById('nonHumansDiv').style.display = "none";
    } else if (document.getElementById('nonHumanRadio').checked) {
        document.getElementById('humansDiv').style.display = "none";
        document.getElementById('nonHumansDiv').style.display = "block";
    } else {
        document.getElementById('humansDiv').style.display = "none";
        document.getElementById('nonHumansDiv').style.display = "none";
    }
}

// function showPartyList(){
//     var partyList = document.getElementById('partyListCandidate');
//     focreach(var i = 0; i <= partyList.length; i++){
//         partyList.remove(0);
//     }

//     for(var i = 0; i < parties.length; i++){
//         var option = document.createElement('option');
//         option.innerHTML = parties[i][0];
//         partyList.appendChild(option);
//     }
// }

function deleteCandidate(id) {
    var row = id.parentNode.parentNode;
    var id;
    for (var i = 0; i < candidates.length; i++) {
        for (var j = 0; j < positions.length; j++) {
            if (positions[j][0] == row.parentNode.parentNode.parentNode.childNodes[0].innerHTML) {
                id = positions[j][1];
            }
        }

        if (candidates[i][2] == row.childNodes[1].innerHTML && candidates[i][0] == id) {
            candidates.splice(i, 1);
        }
    }

    row.parentNode.removeChild(row);

    if (candidates.length == 0) {
        document.getElementById('candidateTable' + id).style.visibility = "hidden";
    }
    console.log(row.childNodes[1].innerHTML);
    console.log(candidates);
    console.log(candidates.length);
}

function addCandidateToList() {
    var position = document.getElementById('positionListCandidate');
    var name = document.getElementById('cName');
    var email = document.getElementById('cEmail');
    var party = document.getElementById('partyListCandidate');
    var tbody = document.getElementById('candidateTableBody');

    var cNameError = document.getElementById('cNameError');
    var cEmailError = document.getElementById('cEmailError');

    if (name.value == "") {
        cNameError.innerHTML = "Candidate name is required";
        name.focus();
        return;
    }

    if (email.value == "") {
        cEmailError.innerHTML = "Candidate email is required";
        email.focus();
        return;
    }

    for (var i = 0; i < candidates.length; i++) {
        if (candidates[i][2] == email.value && candidates[i][0] == position.value) {
            cEmailError.innerHTML = "Candidate for this email already exists";
            email.focus();
            return;
        }
    }

    candidates.push([position.value, name.value, email.value, party.value]);

    var row = document.createElement('tr');
    var namecell = document.createElement('td');
    var emailcell = document.createElement('td');
    var partycell = document.createElement('td');
    var action = document.createElement('td');

    var deleteBtn = document.createElement('button');
    deleteBtn.innerHTML = "Delete";
    deleteBtn.setAttribute('onclick', 'deleteCandidate(this)');
    deleteBtn.setAttribute('class', 'btn btn-danger');
    action.appendChild(deleteBtn);

    namecell.innerHTML = name.value;
    emailcell.innerHTML = email.value;

    if (party.value == 0) {
        partycell.innerHTML = "No Party";
    } else {
        partycell.innerHTML = party.value;
    }

    row.appendChild(namecell);
    row.appendChild(emailcell);
    row.appendChild(partycell);
    row.appendChild(action);

    document.getElementById('candidateTable' + position.value).style.visibility = "visible";
    var tablebody = document.getElementById('candidateTableBody' + position.value);
    tablebody.appendChild(row);

    console.log(candidates);

    name.value = "";
    email.value = "";
}

document.getElementById("submissionForm").addEventListener("submit", () => {
    const cnt = candidates.length;
    for (var i = 0; i < candidates.length; i++) {
        var posi = document.createElement('input');
        posi.type = "hidden";
        posi.name = i + "position";
        posi.value = candidates[i][0];

        var name = document.createElement('input');
        name.type = "hidden";
        name.name = i + "name";
        name.value = candidates[i][1];

        var email = document.createElement('input');
        email.type = "hidden";
        email.name = i + "email";
        email.value = candidates[i][2];

        var pty = document.createElement('input');
        pty.type = "hidden";
        pty.name = i + "party";
        pty.value = candidates[i][3];

        document.getElementById("submissionForm").appendChild(posi);
        document.getElementById("submissionForm").appendChild(name);
        document.getElementById("submissionForm").appendChild(email);
        document.getElementById("submissionForm").appendChild(pty);
    }

    var cntIn = document.createElement('input');
    cntIn.type = "hidden";
    cntIn.name = "count";
    cntIn.value = cnt;
    document.getElementById("submissionForm").appendChild(cntIn);

    for (var i = 0; i < parties.length; i++) {
        var partyName = document.createElement('input');
        partyName.type = "hidden";
        partyName.name = "partyName" + i;
        partyName.value = parties[i][0];

        var partySupName = document.createElement('input');
        partySupName.type = "hidden";
        partySupName.name = "partySupName" + i;
        partySupName.value = parties[i][1];

        var partySupEmail = document.createElement('input');
        partySupEmail.type = "hidden";
        partySupEmail.name = "partySupEmail" + i;
        partySupEmail.value = parties[i][2];


        document.getElementById("submissionForm").appendChild(partyName);
        document.getElementById("submissionForm").appendChild(partySupName);
        document.getElementById("submissionForm").appendChild(partySupEmail);
    }

    var partyCnt = document.createElement('input');
    partyCnt.type = "hidden";
    partyCnt.name = "partyCount";
    partyCnt.value = parties.length;

    document.getElementById("submissionForm").appendChild(partyCnt);

    document.getElementById("submissionForm").submit();

})
var count = 0;
var form = document.getElementById('form');
    
function find_duplicates(x){
    var rows = document.getElementById('positionList').getElementsByTagName('tr');
    for (let i = 0; i < rows.length; i++) {
        var tbrow = rows[i].getElementsByTagName('td');
        var name = tbrow[0].innerHTML;
        if (name == x) {
            return true;
        }
    }
}

function addPosition(){
    
    document.getElementById('nameerror').innerHTML = "";

    var positionName = document.getElementById('positionName').value;
    var description = document.getElementById('positionDesc').value;
    var noOfOptions = document.getElementById('noOfOptions').value;
    var positionList = document.getElementById('positionList');

    if (positionName == "") {
        document.getElementById('nameerror').innerHTML = "Position name is required";
        document.getElementById('positionName').focus();
        return;
    }

    if (find_duplicates(positionName)) {
        document.getElementById('nameerror').innerHTML = "Position already exists";
        document.getElementById('positionName').focus();
        return;
    }
    count++;
    var row = document.createElement('tr');
    var descRow = document.createElement('tr');
    
    row.setAttribute('id', count);
    descRow.setAttribute('id', count+"desc");
    descRow.setAttribute('style', 'display:none');

    var positionNameCell = document.createElement('td');
    var noOfOptionsCell = document.createElement('td');
    var desc = document.createElement('td');
    var Buttons = document.createElement('td');
    desc.setAttribute('colspan', '4');
    desc.setAttribute('style', 'text-align: center;');
    var actionCell = document.createElement('button');
    var extendDesc = document.createElement('button');
    
    positionNameCell.innerHTML = positionName;
    noOfOptionsCell.innerHTML = noOfOptions;
    desc.innerHTML = description;

    actionCell.innerHTML = "Delete";
    actionCell.setAttribute('onclick', 'deletePosition(this.id)');
    actionCell.setAttribute('id', count);
    actionCell.classList.add('btn');
    actionCell.classList.add('btn-danger');
    actionCell.classList.add('mr-1');

    extendDesc.innerHTML = "Extend";
    extendDesc.setAttribute('onclick', 'extendDesc(this.id)');
    extendDesc.setAttribute('id', count);
    extendDesc.setAttribute('name', 'extendDesc');
    extendDesc.classList.add('btn');
    extendDesc.classList.add('btn-primary');

    Buttons.appendChild(actionCell);
    Buttons.appendChild(extendDesc);

    row.appendChild(positionNameCell);
    row.appendChild(noOfOptionsCell);
    row.appendChild(Buttons);

    descRow.appendChild(desc);
    
    positionList.appendChild(row);
    positionList.appendChild(descRow);

    document.getElementById('count').innerHTML = count;
    document.getElementById('allPositions').style.display = "block";
}

function deletePosition(id) {
    document.getElementById('positionList').removeChild(document.getElementById(id));
    document.getElementById('positionList').removeChild(document.getElementById(id+"desc"));
    count--;
    document.getElementById('count').innerHTML = count;
    if (count == 0) {
        document.getElementById('allPositions').style.display = "none";
    }
    console.log('delete: ' + id);
}

function extendDesc(id) {
    var desc = document.getElementById(id+"desc");
    if (desc.style.display == "none") {
        desc.style.display = "table-row";
    } else {
        desc.style.display = "none";
    }
}

form.addEventListener('submit', (e)=>{
    e.preventDefault();
    var count=0;

    var rows = document.getElementById('positionList').getElementsByTagName('tr');

    for(var i = 0; i < rows.length; i++){
        count++;

        var tbrow = rows[i].getElementsByTagName('td');
        var name = tbrow[0].innerHTML;
        var noOfOptions = tbrow[1].innerHTML;
        var descrow = rows[++i].getElementsByTagName('td');
        var desc = descrow[0].innerHTML;

        var inputPositionName = document.createElement('input');
        var inputNoOfOptions = document.createElement('input');
        var inputDesc = document.createElement('input');

        

        inputPositionName.setAttribute('type', 'hidden');
        inputPositionName.setAttribute('name', count+'positionName');
        inputPositionName.setAttribute('value', name);

        inputNoOfOptions.setAttribute('type', 'hidden');
        inputNoOfOptions.setAttribute('name', count+'noOfOptions');
        inputNoOfOptions.setAttribute('value', noOfOptions);

        inputDesc.setAttribute('type', 'hidden');
        inputDesc.setAttribute('name', count+'desc');
        inputDesc.setAttribute('value', desc);

        form.appendChild(inputPositionName);
        form.appendChild(inputNoOfOptions);
        form.appendChild(inputDesc);

        
    }

    var inputCount = document.createElement('input');
    inputCount.setAttribute('type', 'hidden');
    inputCount.setAttribute('name', 'count');
    inputCount.setAttribute('value', count);
    form.appendChild(inputCount);

    form.submit();
})

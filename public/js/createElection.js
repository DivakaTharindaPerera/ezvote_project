function ObjStatus(){
    if(document.getElementById("objStatus").checked){
        document.getElementById("objstart").style.display = "block";
        document.getElementById("objend").style.display = "block";

        
        document.getElementById("OstartDate").disabled = false;
        document.getElementById("OstartDate").setAttribute("required", "");
        document.getElementById("OendDate").disabled = false;
        document.getElementById("OendDate").setAttribute("required", "");
        document.getElementById("OstartTime").disabled = false;
        document.getElementById("OstartTime").setAttribute("required", "");
        document.getElementById("OendTime").disabled = false;
        document.getElementById("OendTime").setAttribute("required", "");
    }else{
        document.getElementById("objstart").style.display = "none";
        document.getElementById("objend").style.display = "none";

        document.getElementById("OstartDate").disabled = true;
        document.getElementById("OstartDate").removeAttribute("required");
        document.getElementById("OendDate").disabled = true;
        document.getElementById("OendDate").removeAttribute("required");
        document.getElementById("OstartTime").disabled = true;
        document.getElementById("OstartTime").removeAttribute("required");
        document.getElementById("OendTime").disabled = true;
        document.getElementById("OendTime").removeAttribute("required");
    }
}

function Snomi(){
    if(document.getElementById("selfNomi").checked){
        document.getElementById("nomi-description").disabled = false;
        document.getElementById("nomi-description").setAttribute("required", "");
    }else{
        document.getElementById("nomi-description").disabled = true;
        document.getElementById("nomi-description").removeAttribute("required");
    }
}

function dateCheck(){
    var s = new Date(document.getElementById("EstartDate").value);
    var e = new Date(document.getElementById("EendDate").value);

    if(s > e){
        document.getElementById("out").innerHTML = "Election ending date must be same starting date or after starting date";   
        document.getElementById("sbmit").disabled = true;
    }else{
        document.getElementById("out").innerHTML = "";
        document.getElementById("sbmit").disabled = false;
    }

}

function timeCheck(){
    var s = document.getElementById("EstartTime").value;
    var e = document.getElementById("EendTime").value;

    // document.getElementById("out").innerHTML = s+" | "+e;
    if(s > e){
        document.getElementById("out").innerHTML = "Election ending time should be after the starting time";
        document.getElementById("sbmit").disabled = true;
    }else if(s == e){
        document.getElementById("out").innerHTML = "Election ending time should be after the starting time";
        document.getElementById("sbmit").disabled = true;
    }else{
        document.getElementById("out").innerHTML = "";
        document.getElementById("sbmit").disabled = false;
    }
}

function dateCheckO(){
    var s = new Date(document.getElementById("OstartDate").value);
    var e = new Date(document.getElementById("OendDate").value);

    if(s > e){
        document.getElementById("out1").innerHTML = "Election ending date must be same starting date or after starting date";   
        document.getElementById("sbmit").disabled = true;
    }else{
        document.getElementById("out1").innerHTML = "";
        document.getElementById("sbmit").disabled = false;
    }

}

function timeCheckO(){
    var s = document.getElementById("OstartTime").value;
    var e = document.getElementById("OendTime").value;

    // document.getElementById("out").innerHTML = s+" | "+e;
    if(s > e){
        document.getElementById("out1").innerHTML = "Objection ending time should be after the starting time "+s+" | "+e;
        document.getElementById("sbmit").disabled = true;
    }else if(s == e){
        document.getElementById("out1").innerHTML = "Objection ending time should be after the starting time";
        document.getElementById("sbmit").disabled = true;
    }else{
        document.getElementById("out1").innerHTML = "";
        document.getElementById("sbmit").disabled = false;
    }
}
function edit(){
    var inputs = document.getElementById('information').getElementsByTagName( 'input' );
    var areas = document.getElementById('information').getElementsByTagName( 'textarea' );

    for (var i = 0; i < areas.length; i++) {
        areas[i].disabled = false;
    }

    for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = false;
    }
    inputs[0].focus();
    var btn = document.getElementById("editBtn");
    btn.setAttribute("type","submit");
    btn.setAttribute("class", "btn btn-primary w-30");
    btn.setAttribute("onclick", "update()");
    btn.innerHTML = "<b>Save Changes</b>";

    var cncl = document.createElement("button");
    cncl.innerHTML = "<b>Cancel</b>";
    cncl.setAttribute("class", "btn btn-danger ml-2 w-30");
    cncl.setAttribute("type", "button");
    cncl.setAttribute("onclick", "cancel()");

    var div = document.getElementById('buttonContainer');
    div.appendChild(cncl);
}

function cancel(){
    var inputs = document.getElementById('information').getElementsByTagName( 'input' );
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = true;
    }
    var btn = document.getElementById("editBtn");
    btn.setAttribute("class", "btn btn-primary w-30");
    btn.setAttribute("onclick", "edit()");
    btn.innerHTML = "<b>Edit</b>";

    var div = document.getElementById('buttonContainer');
    div.removeChild(div.lastChild);

    location.reload();
}

function update(){
    var form = document.getElementById("updateForm");

    form.submit();
}


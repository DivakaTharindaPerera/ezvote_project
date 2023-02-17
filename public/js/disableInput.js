function yesnoCheck() {
    if (document.getElementById('free').checked) {
        document.getElementById('price').style.display = 'none';
    }
    if (document.getElementById('free-2').checked) {
        document.getElementById('price').style.display = 'initial';
    }

}

function yesnoCheckDate() {
    if (document.getElementById('time').checked) {
        document.getElementById('day').style.display = 'none';
        document.getElementById('month').style.display = 'none';
        document.getElementById('year').style.display = 'none';
        document.getElementById('text-3').style.display = 'none';
        document.getElementById('text-4').style.display = 'none';
        document.getElementById('text-5').style.display = 'none';
    }
    if (document.getElementById('time-2').checked) {
        document.getElementById('day').style.display = 'initial';
        document.getElementById('month').style.display = 'initial';
        document.getElementById('year').style.display = 'initial';
        document.getElementById('text-3').style.display = 'initial';
        document.getElementById('text-4').style.display = 'initial';
        document.getElementById('text-5').style.display = 'initial';
    }

}

function yesnoCheckAccess() {
    if (document.getElementById('access').checked) {
        document.getElementById('div-access').style.display = 'none';
        document.getElementById('limitation').style.height = 'unset';
        document.getElementById('text-box1').style.height = '433px';
        document.getElementById('down').style.marginTop = '155px';
    }
    else  {
        document.getElementById('div-access').style.display = 'initial';
        document.getElementById('text-box1').style.height = '602px';
        document.getElementById('down').style.marginTop = '330px';

    }

}

function disableInput1() {
    if(document.getElementById('candidate').checked){
        document.getElementById("box-1").disabled = false;
    }
    else {
        document.getElementById("box-1").disabled = true;
    }
}

function disableInput2() {
    if(document.getElementById('voter').checked){
        document.getElementById("box-2").disabled = false;
    }
    else {
        document.getElementById("box-2").disabled = true;
    }
}

function disableInput3() {
    if(document.getElementById('election').checked){
        document.getElementById("box-3").disabled = false;
    }
    else {
        document.getElementById("box-3").disabled = true;
    }
}
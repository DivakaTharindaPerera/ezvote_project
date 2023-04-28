function showPassword(){
    console.log("showPassword")
    if(document.getElementById('changePassword_check').checked){
        document.getElementById('changePassword').style.display = "block";
    }
}

function confirmOld(){
    console.log("confirmOld")
    window.location.href = "pages/editProfile";
}

function showNewPassword(){
    console.log("confirmNew")
    document.getElementById('getNewPassword').style.display = "block";
    window.location.href = "pages/editProfile";
}
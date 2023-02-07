function passConfirmValidation(){
    document.getElementById("passConfirmError").innerHTML = "";
    document.getElementById("regBtn").disabled = false;

    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("passwordConfirm").value;
    if (password != confirmPassword) {
        document.getElementById("passConfirmError").innerHTML = "Passwords do not match...";
        document.getElementById("regBtn").disabled = true;
    }
}
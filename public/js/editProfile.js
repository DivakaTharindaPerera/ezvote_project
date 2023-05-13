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

function changeImage() {
    const profilePicInput = document.getElementById('profile_pic');
    const profilePic = document.getElementById('profile_pic_img');
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.onchange = (event) => {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function () {
            profilePic.src = reader.result;
        };
        reader.readAsDataURL(file);
        const url = '/ezvote/pages/uploadProfileImage';
        const formData = new FormData();
        formData.append('profile_pic', file);
        fetch(url, {
            method: 'POST',
            body: formData,
        }).then(response => response.json())
            .then(data => {
                console.log(data)
            })

    }
    input.click();
}
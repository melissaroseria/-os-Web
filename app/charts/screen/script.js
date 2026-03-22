function changeBackground() {
    const bgUpload = document.getElementById('bgUpload').files[0];
    if (bgUpload) {
        const formData = new FormData();
        formData.append("wallpaper", bgUpload);

        fetch('upload.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const wallpaperImage = document.querySelector('.background-image');
                wallpaperImage.src = data.wallpaperPath;
            } else {
                alert(data.message);  // Hata mesajını göster
            }
        })
        .catch(error => alert('Bir hata oluştu, lütfen tekrar deneyin.'));
    }
}

function changeProfile() {
    const profileUpload = document.getElementById('profileUpload').files[0];
    if (profileUpload) {
        const formData = new FormData();
        formData.append("profileImage", profileUpload);

        fetch('upload.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const profileImage = document.querySelector('.profile-image');
                profileImage.src = data.profileImagePath;
            } else {
                alert(data.message);  // Hata mesajını göster
            }
        })
        .catch(error => alert('Bir hata oluştu, lütfen tekrar deneyin.'));
    }
}

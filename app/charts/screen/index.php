<?php
$targetDir = "../../run/assets/user/src/";
$wallpaperPath = $targetDir . "background.jpg";
$profileImagePath = "../../run/assets/user/plus/users.png";

// Yükleme işlemi varsa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['wallpaper']) && $_FILES['wallpaper']['error'] == UPLOAD_ERR_OK) {
        move_uploaded_file($_FILES['wallpaper']['tmp_name'], $wallpaperPath);
    }
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == UPLOAD_ERR_OK) {
        move_uploaded_file($_FILES['profileImage']['tmp_name'], $profileImagePath);
    }
    
    header("Location: index.php");
    exit();
}

$wallpaperSrc = file_exists($wallpaperPath) ? $wallpaperPath : '../../run/assets/default/background.jpg';
$profileImageSrc = file_exists($profileImagePath) ? $profileImagePath : '../../run/assets/default/users.png';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/boot-screens.css">
    <title>Duvar Kağıdı ve Profil Resmi Değiştirme</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="cover-photo">
                <div class="image-frame">
                    <img src="<?php echo $wallpaperSrc; ?>" alt="Kapak Fotoğrafı" class="background-image">
                    <div class="profile-image-container">
                        <img src="<?php echo $profileImageSrc; ?>" alt="Profil Resmi" class="profile-image">
                    </div>
                </div>
            </div>
        </div>
        <div class="change-section">
            <div class="change-frame">
                <h3>Kapak Fotoğrafı</h3>
                <input type="file" id="bgUpload" class="file-input" accept="image/*">
                <label for="bgUpload" class="file-label">SEÇ</label>
                <button class="change-btn" onclick="changeBackground()">DEĞİŞTİR</button>
            </div>
            <div class="change-frame">
                <h3>Profil Resmi</h3>
                <input type="file" id="profileUpload" class="file-input" accept="image/*">
                <label for="profileUpload" class="file-label">SEÇ</label>
                <button class="change-btn" onclick="changeProfile()">DEĞİŞTİR</button>
            </div>
            <button class="apply-btn" onclick="applyChanges()">UYGULA</button>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
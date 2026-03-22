<?php
$targetDir = "../../run/assets/user/src/";
$wallpaperPath = $targetDir . "background.jpg";
$profileImagePath = "../../run/assets/user/plus/users.png";
$response = ['success' => false, 'message' => ''];

$maxFileSize = 8 * 1024 * 1024 * 1024; // 8 GB limit
$allowedExtensions = ['jpeg', 'jpg', 'png', 'gif']; // Kabul edilen uzantılar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach (['wallpaper', 'profileImage'] as $key) {
        if (isset($_FILES[$key]) && $_FILES[$key]['error'] == UPLOAD_ERR_OK) {
            $file = $_FILES[$key];
            $tempPath = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $targetPath = ($key === 'wallpaper') ? $wallpaperPath : $profileImagePath;

            if ($fileSize > $maxFileSize) {
                $response['message'] = ucfirst($key) . " dosyası çok büyük. Lütfen 8 GB veya daha küçük bir dosya yükleyin.";
            } elseif (!in_array($fileExtension, $allowedExtensions)) {
                $response['message'] = ucfirst($key) . " dosya türü desteklenmiyor. Lütfen JPEG, JPG, PNG veya GIF yükleyin.";
            } else {
                // Eski dosyayı sil
                if (file_exists($targetPath)) {
                    unlink($targetPath);
                }
                // Yeni dosyayı yükle
                if (move_uploaded_file($tempPath, $targetPath)) {
                    $response['success'] = true;
                    $response[$key . 'Path'] = $targetPath;
                } else {
                    $response['message'] = ucfirst($key) . " yüklenemedi. Lütfen tekrar deneyin.";
                }
            }
        } else {
            $response['message'] = ucfirst($key) . " yüklenemedi. Dosya seçimi sırasında bir hata oluştu.";
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
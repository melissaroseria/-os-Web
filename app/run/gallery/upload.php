<?php
// Hata raporlamayı kapatıyoruz ki yönlendirme bozulmasın
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $uploadDir = 'uploads/';
    
    // Klasör yoksa oluştur
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($_FILES['file']['name']);
    $uploadFile = $uploadDir . $fileName;

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'mp4'];
    $fileExtension = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedExtensions)) {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            // BAŞARILI: Galeriye geri dön ve sayfayı yenilemiş ol
            header("Location: index.php?upload=success");
            exit;
        } else {
            // HATA: Dosya taşınamadıysa yine geri dön ama hata parametresiyle
            header("Location: index.php?error=upload_failed");
            exit;
        }
    } else {
        // HATA: Geçersiz format
        header("Location: index.php?error=invalid_format");
        exit;
    }
} else {
    // POST gelmediyse direkt ana sayfaya at
    header("Location: index.php");
    exit;
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) { mkdir($uploadDir, 0777, true); }

    $ip = $_SERVER['REMOTE_ADDR']; // Yükleyenin IP adresi
    $timestamp = time();
    $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    
    // Dosya adını IP ve zaman damgasıyla kaydediyoruz ki sonra okuyabilelim
    // Örnek: 192.168.1.1_1711123456.jpg
    $newFileName = $ip . "_" . $timestamp . "." . $extension;
    $targetFile = $uploadDir . $newFileName;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        header('Location: index.php'); // Başarılıysa geri dön
    }
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $uploadDir = 'uploads/';
    $ip = $_SERVER['REMOTE_ADDR']; 
    $fileName = $ip . "_" . time() . "_" . basename($_FILES['file']['name']);
    
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir . $fileName)) {
        header('Location: index.php');
    }
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) { mkdir($uploadDir, 0777, true); }

    $ip = $_SERVER['REMOTE_ADDR']; // Yükleyenin IP'si
    $fileName = $ip . "_" . time() . "_" . basename($_FILES['file']['name']);
    
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir . $fileName);
    header('Location: index.php');
}
?>

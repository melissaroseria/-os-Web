<?php
session_start();

// Şifre dosyası var mı kontrolü
if (!file_exists("../../../src/pass.txt")) {
    header("Location: password.php");
    exit;
}

// Form gönderildiğinde şifre doğrulama
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredPassword = $_POST['password'];
    $storedPassword = trim(file_get_contents("../../../src/pass.txt"));  // Dosya yolunu güncelledik

    if ($enteredPassword === $storedPassword) {
        $_SESSION['loggedin'] = true;
        header("Location: ../../src/main.php");
        exit;
    } else {
        $errorMessage = "Şifre yanlış, lütfen tekrar deneyin.";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayarlar - Güvenlik</title>
    <link rel="stylesheet" href="../../../css/boot-password.css">
</head>
<body class="background">
    <div class="container">
        <!-- Üst Kısım -->
        <div class="header">
            <h2 class="settings-title">Güvenlik Ayarları</h2>
        </div>

        <!-- Şifre Değiştirme Bağlantısı -->
        <div class="settings-menu">
            <a href="change_password.php" class="setting-item">
                <div class="setting-icon">🔒</div>
                <div class="setting-text">ŞİFRE DEĞİŞTİR</div>
            </a>
        </div>

        <!-- Bilgilendirme Kutusu -->
        <div class="info-box">
            <p>• ŞİFRENİZİ UNUTURSANIZ VERİLERE ERİŞİM İMKANI YOKTUR</p>
            <p>• BİR SUNUCU YADA VERİ MERKEZİNDE DEPOLANMAZ BU YÜZDEN AKILLICA SEÇİM YAPMAK EN MANTIKLISI OLACAKTIR</p>
        </div>
    </div>
</body>
</html>
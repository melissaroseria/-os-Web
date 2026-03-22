<?php
session_start();

$message = ""; // Varsayılan olarak boş mesaj

// Şifre güncelleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['new_password'] ?? null;

    if ($newPassword) {
        file_put_contents("../../../src/pass.txt", $newPassword);
        $message = "Şifreniz başarıyla güncellendi.";
    } else {
        $message = "Lütfen geçerli bir şifre girin.";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/boot-change.css">
    <title>Şifreyi Değiştir</title>
</head>
<body>
    <div class="container">
        <!-- Profil Tarzı Yuvarlak Kilit İkonu -->
        <div class="profile-icon">
            <img src="../img/lock.png" alt="Kilit İkonu">
        </div>

        <h2>Şifrenizi Değiştirin</h2>
        
        <!-- Bilgilendirme Mesajı -->
        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <input type="password" name="new_password" placeholder="YENİ ŞİFRENİ BELİRLE" required>
            <button type="submit">GÜNCELLE</button>
        </form>
    </div>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_POST['file'];
    // Güvenlik: Sadece uploads klasöründeki dosyaları sil
    $filePath = 'uploads/' . basename($file);

    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            echo "success";
        } else {
            echo "error";
        }
    }
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    file_put_contents("pass.txt", $password);
    echo "Şifre kaydedildi.";
}
?>
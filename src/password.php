<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifre Oluştur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Şifre Oluştur</h2>
        <form action="save_password.php" method="POST">
            <input type="password" name="password" placeholder="Şifrenizi girin" required>
            <button type="submit">Şifreyi Kaydet</button>
        </form>
    </div>
</body>
</html>
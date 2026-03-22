<?php
// Albüm adı ile fotoğrafları listele
$album = basename($_GET['album']);
$photos = glob("uploads/$album/*.*");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $album; ?> Albümü</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <header>
            <h1><?php echo $album; ?> Albümü</h1>
            <nav>
                <button onclick="goBack()">Geri</button>
                <button onclick="deleteAlbum('<?php echo $album; ?>')">Albümü Sil</button>
            </nav>
        </header>

        <div class="photos">
            <?php foreach ($photos as $photo): ?>
                <img src="<?php echo $photo; ?>" alt="<?php echo basename($photo); ?>" class="photo">
            <?php endforeach; ?>
        </div>
    </div>

    <script src="js/scripts.js"></script>
</body>
</html>

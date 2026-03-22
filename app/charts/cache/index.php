<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Önbellek Temizleyici</title>
    <link rel="stylesheet" href="../../../css/boot-cache.css">
</head>
<body>
    <div class="container">
        <!-- Üst Çerçeve: Dosya Gösterici -->
        <div class="frame" id="fileViewer">
            <h2>DİSK</h2>
            <div class="indicators">
                <?php
                $directories = [
                    '../../run/gallery/uploads', 
                    '../../run/notes/notes', 
                    '../../run/sudo/uploads',
                    '../../run/post/settings/logs',
                    '../../run/bot/bot',
                ];
                
                foreach ($directories as $dir) {
                    $fileCount = 0;
                    if (is_dir($dir)) {
                        $files = scandir($dir);
                        $fileCount = count(array_diff($files, array('.', '..')));
                    }
                    echo "<div class='circle'><span class='inner-circle'>$fileCount</span></div>";
                }
                ?>
            </div>
            <ul>
                <?php
                foreach ($directories as $dir) {
                    if (is_dir($dir)) {
                        $files = scandir($dir);
                        foreach ($files as $file) {
                            if ($file !== '.' && $file !== '..') {
                                echo "<li>$file</li>";
                            }
                        }
                    }
                }
                ?>
            </ul>
        </div>

        <!-- Alt Çerçeve: Dosya Temizleyici -->
        <div class="frame" id="fileCleaner">
            <h2>TEMİZLİK</h2>
            <div class="indicators">
                <div class="circle">$file<span class="inner-circle">%</span></div>
                <div class="circle">$file<span class="inner-circle">%</span></div>
            </div>
            <form method="POST">
                <button type="submit" name="deleteFiles">Temizle</button>
            </form>
            <?php
            if (isset($_POST['deleteFiles'])) {
                foreach ($directories as $dir) {
                    if (is_dir($dir)) {
                        $files = scandir($dir);
                        foreach ($files as $file) {
                            if ($file !== '.' && $file !== '..') {
                                unlink("$dir/$file");
                            }
                        }
                    }
                }
                echo "<p>Dosyalar silindi!</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
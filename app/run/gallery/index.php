<?php
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) { mkdir($uploadDir, 0777, true); }

// --- 1. SİLME FONKSİYONU ---
if (isset($_POST['delete_file'])) {
    $fileToDelete = $_POST['delete_file'];
    if (file_exists($fileToDelete) && strpos($fileToDelete, $uploadDir) === 0) {
        unlink($fileToDelete);
    }
    header("Location: index.php");
    exit;
}

// --- 2. IP KAYITLI YÜKLEME FONKSİYONU ---
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $timestamp = time();
    $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $newName = $ip . "_" . $timestamp . "." . $extension;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir . $newName)) {
        header("Location: index.php");
        exit;
    }
}

// Medyaları çek ve tarihe göre sırala
$allMedia = glob($uploadDir . '*.{jpg,jpeg,png,mp4}', GLOB_BRACE);
usort($allMedia, function($a, $b) { return filemtime($b) - filemtime($a); });

// Rastgele bir kapak
$randomPhoto = !empty($allMedia) ? $allMedia[array_rand($allMedia)] : 'https://via.placeholder.com/300x300?text=Klasör';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Photos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/ios-gallery.css">
    <style>
        body { margin: 0; background: #000; font-family: -apple-system, sans-serif; color: #fff; overflow-x: hidden; }
        .top-nav { padding: 45px 20px 10px; display: flex; justify-content: space-between; align-items: flex-end; }
        .date-title { font-size: 32px; font-weight: bold; letter-spacing: -1px; }
        .select-btn { color: #007AFF; font-size: 17px; }

        /* Arama Alanı */
        .search-container { padding: 5px 16px 15px; display: flex; justify-content: center; }
        .search-wrapper { position: relative; width: 100%; background: #1C1C1E; border-radius: 10px; display: flex; align-items: center; padding: 8px 12px; }
        .search-input { background: transparent; border: none; color: #fff; margin-left: 8px; outline: none; width: 100%; font-size: 16px; }

        /* Medya Izgarası */
        .media-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2px; }
        .media-card { aspect-ratio: 1/1; overflow: hidden; cursor: pointer; position: relative; }
        .media-card img, .media-card video { width: 100%; height: 100%; object-fit: cover; }

        /* Tam Ekran Viewer */
        .ios-viewer { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #000; display: none; z-index: 9999; flex-direction: column; justify-content: center; }
        .v-header { position: absolute; top: 50px; width: 100%; padding: 0 20px; box-sizing: border-box; display: flex; justify-content: space-between; color: #007AFF; font-size: 18px; z-index: 10001; }
        .v-bottom { position: absolute; bottom: 40px; width: 100%; display: flex; justify-content: space-around; font-size: 24px; color: #007AFF; padding: 20px 0; background: rgba(0,0,0,0.4); backdrop-filter: blur(15px); }

        /* iOS Bilgi Paneli */
        .info-sheet { position: fixed; bottom: -100%; left: 0; width: 100%; background: rgba(28,28,30,0.9); backdrop-filter: blur(25px); border-radius: 20px 20px 0 0; transition: 0.4s; z-index: 10002; padding: 25px; box-sizing: border-box; }
        .info-sheet.active { bottom: 0; }
        .info-row { background: rgba(255,255,255,0.05); padding: 15px; border-radius: 12px; margin-bottom: 10px; display: flex; justify-content: space-between; }

        /* Silme Animasyonu */
        @keyframes deleteFly { 0% { transform: scale(1); opacity: 1; } 100% { transform: scale(0.1) translateY(500px); opacity: 0; } }
        .deleted { animation: deleteFly 0.6s forwards; }

        .tab-content { display: none; padding-bottom: 120px; }
        .tab-content.active { display: block; }
    </style>
</head>
<body>

<div class="top-nav">
    <span class="date-title" id="page-title">Kitaplık</span>
    <span class="select-btn">Seç</span>
</div>

<div id="tab-library" class="tab-content active">
    <div class="media-grid">
        <?php foreach ($allMedia as $file): 
            $fname = basename($file);
            $ipParts = explode('_', $fname);
            $ip = (count($ipParts) > 1 && filter_var($ipParts[0], FILTER_VALIDATE_IP)) ? $ipParts[0] : "Bilinmiyor";
        ?>
            <div class="media-card" onclick="openMedia('<?php echo $file; ?>', '<?php echo $ip; ?>')">
                <img src="<?php echo $file; ?>" loading="lazy">
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div id="tab-foryou" class="tab-content" style="padding:16px;">
    <div style="background:#1C1C1E; border-radius:15px; overflow:hidden;">
        <img src="<?php echo $randomPhoto; ?>" style="width:100%; height:300px; object-fit:cover;">
        <div style="padding:15px;"><h3>Anılar</h3><p style="color:#8E8E93;">Harika bir günden kesitler...</p></div>
    </div>
</div>

<div id="tab-search" class="tab-content">
    <div class="search-container">
        <div class="search-wrapper">
            <i class="fas fa-search" style="color:#8E8E93;"></i>
            <input type="text" class="search-input" placeholder="Fotoğraflarda Ara" onkeyup="filterGallery(this.value)">
        </div>
    </div>
    <div class="media-grid" id="search-results"></div>
</div>

<div id="tab-albums" class="tab-content" style="padding:16px;">
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:15px;">
        <div>
            <img src="<?php echo $randomPhoto; ?>" style="width:100%; aspect-ratio:1/1; object-fit:cover; border-radius:12px;">
            <p style="margin:5px 0 0; font-weight:bold;">Son Kaydedilenler</p>
            <p style="margin:0; color:#8E8E93; font-size:14px;"><?php echo count($allMedia); ?></p>
        </div>
    </div>
</div>

<div id="mediaViewer" class="ios-viewer">
    <div class="v-header">
        <span onclick="closeMedia()"><i class="fas fa-chevron-left"></i> Geri</span>
        <i class="fas fa-ellipsis-h"></i>
    </div>
    <div id="vContent" style="width:100%; text-align:center;"></div>
    <div class="v-bottom">
        <i class="fas fa-share"></i>
        <i class="far fa-heart"></i>
        <i class="fas fa-info-circle" onclick="toggleInfo()"></i>
        <i class="far fa-trash-alt" onclick="confirmDelete()"></i>
    </div>
</div>

<div id="infoSheet" class="info-sheet">
    <div style="width:40px; height:5px; background:#38383A; border-radius:5px; margin:-10px auto 20px;" onclick="toggleInfo()"></div>
    <h3 style="text-align:center; margin-top:0;">Görsel Bilgisi</h3>
    <div class="info-row"><b>Gönderen IP:</b> <span id="displayIp">-</span></div>
    <div class="info-row"><b>Konum:</b> <span>Türkiye</span></div>
    <button onclick="toggleInfo()" style="width:100%; background:#007AFF; border:none; color:#fff; padding:15px; border-radius:15px; font-weight:bold; margin-top:10px;">Kapat</button>
</div>

<footer class="ios-tab-bar" id="mainFooter" style="position:fixed; bottom:0; width:100%; background:rgba(20,20,20,0.8); backdrop-filter:blur(20px); display:flex; justify-content:space-around; padding:10px 0 30px; border-top:0.3px solid #333; z-index:500;">
    <div class="tab-item active" onclick="switchTab('library', 'Kitaplık', this)" style="text-align:center; flex:1; color:#007AFF;"><i class="fas fa-image" style="font-size:22px;"></i><br><span style="font-size:10px;">Kitaplık</span></div>
    <div class="tab-item" onclick="switchTab('foryou', 'Sizin İçin', this)" style="text-align:center; flex:1; color:#8E8E93;"><i class="fas fa-heart" style="font-size:22px;"></i><br><span style="font-size:10px;">Sizin İçin</span></div>
    <div class="tab-item" onclick="document.getElementById('fileInput').click()" style="text-align:center; flex:1; color:#007AFF;"><i class="fas fa-plus-circle" style="font-size:26px;"></i><br><span style="font-size:10px;">Yükle</span></div>
    <div class="tab-item" onclick="switchTab('albums', 'Albümler', this)" style="text-align:center; flex:1; color:#8E8E93;"><i class="fas fa-layer-group" style="font-size:22px;"></i><br><span style="font-size:10px;">Albümler</span></div>
    <div class="tab-item" onclick="switchTab('search', 'Ara', this)" style="text-align:center; flex:1; color:#8E8E93;"><i class="fas fa-search" style="font-size:22px;"></i><br><span style="font-size:10px;">Ara</span></div>
</footer>

<form id="uploadForm" method="POST" enctype="multipart/form-data" style="display:none;">
    <input type="file" id="fileInput" name="file" onchange="this.form.submit()">
</form>

<form id="deleteForm" method="POST" style="display:none;">
    <input type="hidden" name="delete_file" id="deleteFilePath">
</form>

<script>
let currentFile = "";

function openMedia(src, ip) {
    currentFile = src;
    document.getElementById('displayIp').innerText = ip;
    document.getElementById('mediaViewer').style.display = 'flex';
    document.getElementById('mainFooter').style.display = 'none';
    document.getElementById('vContent').innerHTML = `<img src="${src}" id="vImg" style="max-width:100%; max-height:70vh; border-radius:8px;">`;
}

function closeMedia() {
    document.getElementById('mediaViewer').style.display = 'none';
    document.getElementById('mainFooter').style.display = 'flex';
    document.getElementById('infoSheet').classList.remove('active');
}

function toggleInfo() {
    document.getElementById('infoSheet').classList.toggle('active');
}

function confirmDelete() {
    if(!confirm("Kanki bu görsel uçsun mu?")) return;
    document.getElementById('vImg').classList.add('deleted');
    setTimeout(() => {
        document.getElementById('deleteFilePath').value = currentFile;
        document.getElementById('deleteForm').submit();
    }, 600);
}

function switchTab(tabId, title, el) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.getElementById('tab-' + tabId).classList.add('active');
    document.getElementById('page-title').innerText = title;
    document.querySelectorAll('.tab-item').forEach(i => i.style.color = '#8E8E93');
    el.style.color = '#007AFF';
}

function filterGallery(val) {
    const results = document.getElementById('search-results');
    results.innerHTML = "";
    document.querySelectorAll('#tab-library .media-card img').forEach(img => {
        if(img.src.toLowerCase().includes(val.toLowerCase())) {
            let clone = img.parentElement.cloneNode(true);
            clone.onclick = () => openMedia(img.src, 'Bilinmiyor');
            results.appendChild(clone);
        }
    });
}
</script>
</body>
</html>

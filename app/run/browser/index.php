<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Safari</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
* { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }

:root {
  --blue: #007AFF;
  --bg: rgba(28,28,30,0.85);
  --card: rgba(44,44,46,0.75);
  --border: rgba(255,255,255,0.10);
  --text: #fff;
  --text2: #8E8E93;
  --blur: blur(40px) saturate(180%);
  --green: #30D158;
  --red: #FF3B30;
}

html, body {
  height: 100%; overflow-x: hidden;
  font-family: -apple-system, 'SF Pro Display', 'Helvetica Neue', sans-serif;
  background: #000;
  color: var(--text);
}

/* ── WALLPAPER ── */
.wallpaper {
  position: fixed; inset: 0; z-index: 0;
  background: url('img/img/bg.jpg') center/cover no-repeat;
}
.wallpaper::after {
  content: ''; position: absolute; inset: 0;
  background: rgba(0,0,0,0.18);
}

/* ── MAIN CONTENT ── */
.safari-content {
  position: relative; z-index: 1;
  padding: 56px 16px 160px;
  min-height: 100vh;
}

/* ── TOP BAR ── */
.top-bar {
  display: flex; justify-content: space-between; align-items: center;
  padding: 8px 0 20px;
}
.top-bar h1 {
  font-size: 32px; font-weight: 700; letter-spacing: -0.5px;
  text-shadow: 0 1px 8px rgba(0,0,0,0.4);
}
.top-bar-right { display: flex; gap: 16px; align-items: center; font-size: 20px; color: var(--blue); }

/* ── SECTION HEADER ── */
.section-header {
  display: flex; justify-content: space-between; align-items: center;
  margin: 28px 0 14px;
}
.section-header h2 { font-size: 20px; font-weight: 700; }
.section-header a { color: var(--blue); font-size: 15px; text-decoration: none; }

/* ── FAVORITES GRID ── */
.icon-grid {
  display: grid; grid-template-columns: repeat(4, 1fr);
  gap: 18px 8px;
}
.icon-item {
  text-decoration: none; color: #fff; text-align: center;
}
.icon-box {
  width: 60px; height: 60px; border-radius: 14px;
  margin: 0 auto 7px; overflow: hidden;
  box-shadow: 0 2px 12px rgba(0,0,0,0.35);
  background: rgba(255,255,255,0.12);
  display: flex; align-items: center; justify-content: center;
}
.icon-box img { width: 60px; height: 60px; object-fit: cover; border-radius: 14px; }
.icon-item span {
  font-size: 11px; display: block;
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
  max-width: 68px; margin: 0 auto;
  text-shadow: 0 1px 4px rgba(0,0,0,0.5);
}

/* ── IOS CARD ── */
.ios-card {
  background: var(--card);
  backdrop-filter: var(--blur); -webkit-backdrop-filter: var(--blur);
  border-radius: 16px; border: 0.5px solid var(--border);
  padding: 14px 16px;
  display: flex; align-items: center; gap: 14px;
  box-shadow: 0 4px 24px rgba(0,0,0,0.25);
}

/* Privacy Report */
.privacy-count {
  font-size: 26px; font-weight: 700; color: var(--blue);
  border-right: 0.5px solid var(--border); padding-right: 14px; flex-shrink: 0;
}
.privacy-text { font-size: 13px; color: rgba(255,255,255,0.8); line-height: 1.5; }

/* Reading list */
.reading-thumb {
  width: 50px; height: 50px; border-radius: 10px; overflow: hidden; flex-shrink: 0;
  background: rgba(255,255,255,0.1);
  display: flex; align-items: center; justify-content: center;
}
.reading-thumb img { width: 32px; height: 32px; }
.reading-info b { font-size: 14px; font-weight: 600; display: block; margin-bottom: 3px; }
.reading-info span { font-size: 12px; color: var(--text2); }

/* ── PROXY STATUS BAR ── */
#proxyStatus {
  display: none;
  background: rgba(48,209,88,0.14);
  backdrop-filter: var(--blur); -webkit-backdrop-filter: var(--blur);
  border: 0.5px solid rgba(48,209,88,0.35);
  border-radius: 14px; padding: 10px 14px;
  margin-top: 16px;
  flex-direction: row; align-items: center; gap: 10px;
}
#proxyStatus.active { display: flex; }
#proxyStatus.error {
  background: rgba(255,59,48,0.14);
  border-color: rgba(255,59,48,0.35);
}
.proxy-dot {
  width: 10px; height: 10px; border-radius: 50%;
  background: var(--green); flex-shrink: 0;
  box-shadow: 0 0 8px rgba(48,209,88,0.8);
  animation: pulse-green 2s infinite;
}
.proxy-dot.err { background: var(--red); box-shadow: 0 0 8px rgba(255,59,48,0.8); animation: none; }
@keyframes pulse-green { 0%,100% { opacity: 1; } 50% { opacity: 0.4; } }
.proxy-info { flex: 1; }
.proxy-info .proxy-label { font-size: 11px; color: rgba(255,255,255,0.5); font-weight: 600; text-transform: uppercase; letter-spacing: 0.4px; }
.proxy-info .proxy-val { font-size: 13px; font-weight: 600; margin-top: 2px; }
.proxy-flag { font-size: 22px; }

/* ── BOTTOM BAR ── */
.safari-bottom {
  position: fixed; bottom: 0; left: 0; right: 0; z-index: 100;
  background: rgba(28,28,30,0.82);
  backdrop-filter: blur(50px) saturate(200%); -webkit-backdrop-filter: blur(50px) saturate(200%);
  border-top: 0.5px solid rgba(255,255,255,0.12);
  padding: 10px 16px calc(env(safe-area-inset-bottom, 16px) + 4px);
}

.address-bar-wrap {
  background: rgba(118,118,128,0.24);
  border-radius: 12px; height: 40px;
  display: flex; align-items: center; padding: 0 12px; gap: 8px;
  margin-bottom: 4px;
}
.address-bar-wrap .lock-icon { color: rgba(255,255,255,0.55); font-size: 12px; }
.address-bar-wrap input {
  flex: 1; background: transparent; border: none; outline: none;
  color: #fff; font-size: 15px; text-align: center;
  font-family: -apple-system, sans-serif;
}
.address-bar-wrap input::placeholder { color: rgba(255,255,255,0.45); }
.address-bar-wrap .reload-btn { color: rgba(255,255,255,0.55); font-size: 15px; cursor: pointer; }

.nav-row {
  display: flex; justify-content: space-around; align-items: center;
  padding-top: 6px;
}
.nav-row i {
  font-size: 20px; color: var(--blue);
  padding: 6px 10px; cursor: pointer;
}
.nav-row i.dim { color: rgba(0,122,255,0.28); }

/* ── SETTINGS MODAL ── */
.modal-overlay {
  position: fixed; inset: 0; z-index: 200;
  background: rgba(0,0,0,0.55);
  backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
  display: flex; align-items: flex-end;
  opacity: 0; pointer-events: none;
  transition: opacity 0.3s ease;
}
.modal-overlay.open { opacity: 1; pointer-events: all; }

.settings-sheet {
  width: 100%; background: rgba(30,30,32,0.97);
  backdrop-filter: var(--blur); -webkit-backdrop-filter: var(--blur);
  border-radius: 20px 20px 0 0;
  border-top: 0.5px solid rgba(255,255,255,0.14);
  padding: 0 0 calc(env(safe-area-inset-bottom,20px) + 10px);
  transform: translateY(100%);
  transition: transform 0.4s cubic-bezier(0.4,0,0.2,1);
  box-shadow: 0 -8px 40px rgba(0,0,0,0.5);
}
.modal-overlay.open .settings-sheet { transform: translateY(0); }

.sheet-handle {
  width: 36px; height: 5px; background: rgba(255,255,255,0.2);
  border-radius: 3px; margin: 10px auto 0;
}

.sheet-title {
  font-size: 17px; font-weight: 600; text-align: center;
  padding: 14px 20px 10px; border-bottom: 0.5px solid var(--border);
}

.settings-group {
  margin: 16px 16px 0;
  background: rgba(255,255,255,0.07);
  border-radius: 14px; overflow: hidden;
  border: 0.5px solid var(--border);
}
.settings-row {
  display: flex; align-items: center; padding: 14px 16px;
  border-bottom: 0.5px solid var(--border); gap: 12px;
}
.settings-row:last-child { border-bottom: none; }
.settings-row .row-icon { font-size: 16px; color: var(--blue); width: 22px; text-align: center; }
.settings-row .row-label { flex: 1; font-size: 15px; }
.settings-row .row-value { font-size: 14px; color: var(--text2); }

/* Toggle */
.ios-toggle {
  width: 52px; height: 32px; border-radius: 16px;
  background: rgba(120,120,128,0.32); border: none; outline: none;
  position: relative; cursor: pointer; transition: background 0.3s ease;
  flex-shrink: 0;
}
.ios-toggle.on { background: var(--green); }
.ios-toggle::after {
  content: ''; position: absolute;
  top: 2px; left: 2px;
  width: 28px; height: 28px; border-radius: 50%;
  background: white;
  box-shadow: 0 2px 6px rgba(0,0,0,0.3);
  transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);
}
.ios-toggle.on::after { transform: translateX(20px); }

/* Spinner */
.proxy-loading {
  display: flex; flex-direction: column; align-items: center;
  padding: 20px 16px 8px; gap: 10px;
}
.spinner {
  width: 28px; height: 28px; border-radius: 50%;
  border: 3px solid rgba(255,255,255,0.12);
  border-top-color: var(--blue);
  animation: spin 0.8s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }
.proxy-loading-text { font-size: 14px; color: var(--text2); }

/* Sheet proxy info */
.proxy-sheet-info {
  margin: 12px 16px 0;
  background: rgba(48,209,88,0.10);
  border: 0.5px solid rgba(48,209,88,0.3);
  border-radius: 14px; padding: 14px 16px;
  display: none; align-items: center; gap: 12px;
}
.proxy-sheet-info.show { display: flex; }
.proxy-sheet-info.err-info {
  background: rgba(255,59,48,0.10);
  border-color: rgba(255,59,48,0.3);
}
.psi-flag { font-size: 30px; }
.psi-text .psi-title { font-size: 12px; color: var(--text2); text-transform: uppercase; letter-spacing: 0.4px; }
.psi-text .psi-ip { font-size: 15px; font-weight: 600; margin-top: 3px; }
.psi-text .psi-country { font-size: 13px; color: var(--green); margin-top: 2px; }
.psi-text .psi-country.err { color: var(--red); }

/* Engine pills */
.engine-label { font-size: 12px; color: var(--text2); margin: 16px 16px 0; text-transform: uppercase; letter-spacing: 0.4px; }
.engine-pills { display: flex; gap: 8px; margin: 8px 16px 0; flex-wrap: wrap; }
.engine-pill {
  padding: 7px 16px; border-radius: 20px; font-size: 13px; font-weight: 500;
  border: 0.5px solid var(--border);
  background: rgba(255,255,255,0.07);
  color: var(--text2); cursor: pointer; transition: all 0.2s;
}
.engine-pill.active { background: var(--blue); border-color: var(--blue); color: #fff; }

/* Sheet buttons */
.sheet-btn {
  margin: 12px 16px 0;
  background: rgba(0,122,255,0.15);
  border: 0.5px solid rgba(0,122,255,0.4);
  border-radius: 14px; padding: 14px;
  width: calc(100% - 32px);
  color: var(--blue); font-size: 15px; font-weight: 600;
  cursor: pointer; font-family: -apple-system, sans-serif;
  display: block;
}
.sheet-btn:active { opacity: 0.7; }
.sheet-btn.close-btn {
  background: rgba(255,255,255,0.07);
  border-color: var(--border); color: #fff;
}
</style>
</head>
<body>

<div class="wallpaper"></div>

<!-- ═══ MAIN CONTENT ═══ -->
<main class="safari-content">

  <div class="top-bar">
    <h1>Safari</h1>
    <div class="top-bar-right">
      <i class="fas fa-cog" onclick="openSettings()" style="cursor:pointer;"></i>
    </div>
  </div>

  <!-- Proxy Status Bar -->
  <div id="proxyStatus">
    <div class="proxy-dot" id="proxyDot"></div>
    <div class="proxy-info">
      <div class="proxy-label">Proxy Aktif</div>
      <div class="proxy-val" id="proxyIpDisplay">—</div>
    </div>
    <div class="proxy-flag" id="proxyFlagDisplay">🌐</div>
  </div>

  <!-- Favorites -->
  <div class="section-header">
    <h2>Favoriler</h2>
    <a href="#">Tümünü Gör</a>
  </div>

  <div class="icon-grid">
    <a href="https://www.google.com" class="icon-item">
      <div class="icon-box"><img src="https://www.google.com/s2/favicons?sz=64&domain=google.com"></div>
      <span>Google</span>
    </a>
    <a href="https://www.youtube.com" class="icon-item">
      <div class="icon-box"><img src="https://www.google.com/s2/favicons?sz=64&domain=youtube.com"></div>
      <span>YouTube</span>
    </a>
    <a href="https://www.instagram.com" class="icon-item">
      <div class="icon-box"><img src="https://www.google.com/s2/favicons?sz=64&domain=instagram.com"></div>
      <span>Instagram</span>
    </a>
    <a href="https://www.github.com" class="icon-item">
      <div class="icon-box"><img src="https://www.google.com/s2/favicons?sz=64&domain=github.com"></div>
      <span>GitHub</span>
    </a>
    <a href="https://www.twitter.com" class="icon-item">
      <div class="icon-box"><img src="https://www.google.com/s2/favicons?sz=64&domain=twitter.com"></div>
      <span>X</span>
    </a>
    <a href="https://www.reddit.com" class="icon-item">
      <div class="icon-box"><img src="https://www.google.com/s2/favicons?sz=64&domain=reddit.com"></div>
      <span>Reddit</span>
    </a>
    <a href="https://www.twitch.tv" class="icon-item">
      <div class="icon-box"><img src="https://www.google.com/s2/favicons?sz=64&domain=twitch.tv"></div>
      <span>Twitch</span>
    </a>
    <a href="https://www.netflix.com" class="icon-item">
      <div class="icon-box"><img src="https://www.google.com/s2/favicons?sz=64&domain=netflix.com"></div>
      <span>Netflix</span>
    </a>
  </div>

  <!-- Privacy Report -->
  <div class="ios-card" style="margin-top:28px;">
    <div class="privacy-count" id="privacyCount">79</div>
    <div class="privacy-text">Son yedi gün içinde Safari, profilinizi oluşturması bilinen takipçilerden IP adresinizi gizledi.</div>
  </div>

  <!-- Reading List -->
  <div class="section-header">
    <h2>Okuma Listesi</h2>
    <a href="#">Tümünü Gör</a>
  </div>

  <div class="ios-card">
    <div class="reading-thumb">
      <img src="https://www.google.com/s2/favicons?sz=64&domain=theatlantic.com">
    </div>
    <div class="reading-info">
      <b>The Secret to Love Is Just Kindness</b>
      <span>theatlantic.com</span>
    </div>
  </div>

  <div class="ios-card" style="margin-top:10px;">
    <div class="reading-thumb">
      <img src="https://www.google.com/s2/favicons?sz=64&domain=wired.com">
    </div>
    <div class="reading-info">
      <b>The Future of AI Is Already Here</b>
      <span>wired.com</span>
    </div>
  </div>

</main>

<!-- ═══ BOTTOM BAR ═══ -->
<footer class="safari-bottom">
  <div class="address-bar-wrap">
    <i class="fas fa-lock lock-icon"></i>
    <input type="text" id="addressInput" placeholder="Arama veya site adresi" onkeydown="handleSearch(event)" oninput="toggleClear()">
    <i class="fas fa-times-circle reload-btn" onclick="clearAddress()" id="clearBtn" style="display:none;"></i>
  </div>
  <div class="nav-row">
    <i class="fas fa-chevron-left dim"></i>
    <i class="fas fa-chevron-right dim"></i>
    <i class="fas fa-share-square"></i>
    <i class="fas fa-book-open"></i>
    <i class="far fa-clone"></i>
  </div>
</footer>

<!-- ═══ SETTINGS MODAL ═══ -->
<div class="modal-overlay" id="settingsModal" onclick="overlayClick(event)">
  <div class="settings-sheet">
    <div class="sheet-handle"></div>
    <div class="sheet-title">Safari Ayarları</div>

    <!-- Search Engine -->
    <div class="engine-label">Arama Motoru</div>
    <div class="engine-pills">
      <div class="engine-pill active" onclick="setEngine('google',this)">Google</div>
      <div class="engine-pill" onclick="setEngine('bing',this)">Bing</div>
      <div class="engine-pill" onclick="setEngine('duckduckgo',this)">DuckDuckGo</div>
      <div class="engine-pill" onclick="setEngine('ecosia',this)">Ecosia</div>
    </div>

    <!-- Proxy -->
    <div class="settings-group" style="margin-top:20px;">
      <div class="settings-row">
        <i class="fas fa-shield-alt row-icon" style="color:#30D158;"></i>
        <span class="row-label">Proxy Kullan</span>
        <button class="ios-toggle" id="proxyToggle" onclick="toggleProxy()"></button>
      </div>
      <div class="settings-row" id="proxyAutoRow" style="display:none;">
        <i class="fas fa-random row-icon"></i>
        <span class="row-label">Otomatik Proxy Seç</span>
        <button class="ios-toggle on" id="autoProxyToggle" onclick="this.classList.toggle('on')"></button>
      </div>
    </div>

    <!-- Spinner -->
    <div id="proxyLoadingDiv" style="display:none;">
      <div class="proxy-loading">
        <div class="spinner"></div>
        <div class="proxy-loading-text">Proxy aranıyor...</div>
      </div>
    </div>

    <!-- Connected info -->
    <div class="proxy-sheet-info" id="proxySheetInfo">
      <div class="psi-flag" id="sheetFlag">🌐</div>
      <div class="psi-text">
        <div class="psi-title">Aktif Proxy</div>
        <div class="psi-ip" id="sheetIp">—</div>
        <div class="psi-country" id="sheetCountry">—</div>
      </div>
    </div>

    <!-- Other toggles -->
    <div class="settings-group" style="margin-top:16px;">
      <div class="settings-row">
        <i class="fas fa-eye-slash row-icon"></i>
        <span class="row-label">Gizli Gezinme</span>
        <button class="ios-toggle" onclick="this.classList.toggle('on')"></button>
      </div>
      <div class="settings-row">
        <i class="fas fa-cookie-bite row-icon" style="color:#FF9F0A;"></i>
        <span class="row-label">Çerezleri Engelle</span>
        <button class="ios-toggle on" onclick="this.classList.toggle('on')"></button>
      </div>
      <div class="settings-row">
        <i class="fas fa-ad row-icon" style="color:#FF3B30;"></i>
        <span class="row-label">Reklam Engelle</span>
        <button class="ios-toggle on" onclick="this.classList.toggle('on')"></button>
      </div>
    </div>

    <button class="sheet-btn" id="newProxyBtn" onclick="refetchProxy()" style="display:none;">
      <i class="fas fa-sync-alt"></i>  Yeni Proxy Al
    </button>
    <button class="sheet-btn close-btn" onclick="closeSettings()">Kapat</button>

  </div>
</div>

<script>
let proxyEnabled = false;
let searchEngine = 'google';
const PROXY_API = 'https://api.proxyscrape.com/v4/free-proxy-list/get?request=display_proxies&proxy_format=protocolipport&format=json';

// ── Address bar ──
function toggleClear() {
  const v = document.getElementById('addressInput').value;
  document.getElementById('clearBtn').style.display = v ? 'block' : 'none';
}
function clearAddress() {
  document.getElementById('addressInput').value = '';
  document.getElementById('clearBtn').style.display = 'none';
}
function handleSearch(e) {
  if (e.key !== 'Enter') return;
  const q = document.getElementById('addressInput').value.trim();
  if (!q) return;
  let url;
  if (/^https?:\/\//.test(q) || /^[\w-]+\.\w{2,}/.test(q)) {
    url = q.startsWith('http') ? q : 'https://' + q;
  } else {
    const engines = {
      google: 'https://www.google.com/search?q=',
      bing: 'https://www.bing.com/search?q=',
      duckduckgo: 'https://duckduckgo.com/?q=',
      ecosia: 'https://www.ecosia.org/search?q='
    };
    url = (engines[searchEngine] || engines.google) + encodeURIComponent(q);
  }
  window.open(url, '_blank');
}

// ── Search engine ──
function setEngine(e, el) {
  searchEngine = e;
  document.querySelectorAll('.engine-pill').forEach(p => p.classList.remove('active'));
  el.classList.add('active');
}

// ── Modal ──
function openSettings() { document.getElementById('settingsModal').classList.add('open'); }
function closeSettings() { document.getElementById('settingsModal').classList.remove('open'); }
function overlayClick(e) { if (e.target.id === 'settingsModal') closeSettings(); }

// ── Proxy ──
function toggleProxy() {
  proxyEnabled = !proxyEnabled;
  document.getElementById('proxyToggle').classList.toggle('on', proxyEnabled);
  document.getElementById('proxyAutoRow').style.display = proxyEnabled ? 'flex' : 'none';
  document.getElementById('newProxyBtn').style.display = proxyEnabled ? 'block' : 'none';

  if (proxyEnabled) {
    fetchProxy();
  } else {
    resetProxyUI();
  }
}

function refetchProxy() { if (proxyEnabled) fetchProxy(); }

async function fetchProxy() {
  setLoading(true);
  try {
    const res = await fetch(PROXY_API);
    const data = await res.json();
    const list = data.proxies || [];
    if (!list.length) throw new Error('empty');

    const p = list[Math.floor(Math.random() * Math.min(list.length, 30))];
    const ip = p.ip || 'Unknown';
    const protocol = (p.protocol || 'http').toUpperCase();
    const countryCode = p.ip_data?.countryCode || p.country || '??';
    const countryName = p.ip_data?.country || countryCode;

    setLoading(false);
    applyProxy({ ip, protocol, countryCode, countryName });
  } catch(err) {
    setLoading(false);
    applyProxyError();
  }
}

function setLoading(show) {
  document.getElementById('proxyLoadingDiv').style.display = show ? 'block' : 'none';
  const info = document.getElementById('proxySheetInfo');
  if (show) info.classList.remove('show');
}

function countryFlag(code) {
  if (!code || code.length !== 2) return '🌐';
  return [...code.toUpperCase()].map(c => String.fromCodePoint(0x1F1E6 + c.charCodeAt(0) - 65)).join('');
}

function applyProxy({ ip, protocol, countryCode, countryName }) {
  const flag = countryFlag(countryCode);

  // Top bar
  const bar = document.getElementById('proxyStatus');
  bar.classList.add('active'); bar.classList.remove('error');
  document.getElementById('proxyDot').classList.remove('err');
  document.getElementById('proxyIpDisplay').textContent = `${protocol} · ${ip}`;
  document.getElementById('proxyFlagDisplay').textContent = flag;

  // Sheet
  const info = document.getElementById('proxySheetInfo');
  info.classList.add('show'); info.classList.remove('err-info');
  document.getElementById('sheetFlag').textContent = flag;
  document.getElementById('sheetIp').textContent = ip;
  const country = document.getElementById('sheetCountry');
  country.textContent = `${flag} ${countryName} · ${protocol}`;
  country.classList.remove('err');

  // Bump counter slightly
  const el = document.getElementById('privacyCount');
  el.textContent = parseInt(el.textContent) + Math.floor(Math.random()*4+1);
}

function applyProxyError() {
  const bar = document.getElementById('proxyStatus');
  bar.classList.add('active','error');
  document.getElementById('proxyDot').classList.add('err');
  document.getElementById('proxyIpDisplay').textContent = 'Bağlantı başarısız';
  document.getElementById('proxyFlagDisplay').textContent = '⚠️';

  const info = document.getElementById('proxySheetInfo');
  info.classList.add('show','err-info');
  document.getElementById('sheetFlag').textContent = '⚠️';
  document.getElementById('sheetIp').textContent = 'Proxy bulunamadı';
  const country = document.getElementById('sheetCountry');
  country.textContent = 'Tekrar deneyin'; country.classList.add('err');
}

function resetProxyUI() {
  document.getElementById('proxyStatus').classList.remove('active','error');
  document.getElementById('proxySheetInfo').classList.remove('show','err-info');
  document.getElementById('proxyLoadingDiv').style.display = 'none';
}
</script>
</body>
</html>
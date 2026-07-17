<?php
require_once __DIR__ . '/includes/db.php';
$db = getDB();

$slug = trim($_GET['slug'] ?? '');
if (!$slug) { header('Location: index.php'); exit; }

$stmt = $db->prepare("SELECT * FROM hs_pages WHERE slug=?");
$stmt->execute([$slug]);
$page = $stmt->fetch();

if (!$page) { header('HTTP/1.0 404 Not Found'); ?>
<!DOCTYPE html><html><head><title>Page Not Found</title></head><body><h1>404 — Page Not Found</h1><a href="index.php">Back Home</a></body></html>
<?php exit; }

$logoPath = $db->query("SELECT value FROM hs_settings WHERE `key`='logo_path'")->fetchColumn() ?: '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($page['title']) ?> — Hexspire Solutions</title>
  <meta name="description" content="<?= htmlspecialchars($page['title']) ?> page for Hexspire Solutions — Web Development & SEO, Peshawar, Pakistan.">
  <link rel="canonical" href="https://hexspiresolutions.com/page.php?slug=<?= htmlspecialchars($slug) ?>">
  <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">
  <link rel="icon" type="image/svg+xml" href="uploads/logo/default.svg">
</head>
<body>

<!-- Animated Background -->
<div id="bg-canvas" aria-hidden="true">
  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>
  <div class="blob blob-3"></div>
  <div class="blob blob-4"></div>
</div>

<!-- Topbar -->
<header class="topbar" id="topbar">
  <div class="container topbar-inner">
    <a href="index.php" class="topbar-brand" id="logo-badge">
      <?php if ($logoPath): ?>
        <img src="<?= htmlspecialchars($logoPath) ?>" alt="Hexspire Solutions Logo" loading="lazy">
      <?php else: ?>
        <div class="brand-hex">H</div>
        <span>Hexspire Solutions</span>
      <?php endif; ?>
    </a>
    <nav class="topbar-links">
      <a href="index.php#services">Services</a>
      <a href="index.php#projects">Projects</a>
      <a href="blog.php">Blog</a>
      <a href="index.php#contact" class="btn btn-primary btn-sm">Contact Us</a>
    </nav>
  </div>
</header>

<!-- Hero Section -->
<div class="inner-hero">
  <img src="assets/images/hero.png" alt="" class="inner-hero-bg-img" aria-hidden="true">
  <div class="inner-hero-overlay"></div>
  <div class="container">
    <span class="inner-hero-label">Hexspire Solutions</span>
    <h1><?= htmlspecialchars($page['title']) ?></h1>
  </div>
</div>

<!-- Page Content -->
<div class="container">
  <div class="page-content-wrap">
    <?= $page['content'] ?>
  </div>
</div>

<!-- Back to Home -->
<div class="container" style="padding-bottom:60px;">
  <a href="index.php" class="btn btn-outline" id="back-to-home-page-btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
    Back to Home
  </a>
</div>

<!-- Footer -->
<footer>
  <div class="container">
    <div class="footer-bottom">
      <p>© <?= date('Y') ?> <span class="orange">Hexspire Solutions</span> — All rights reserved.</p>
      <div class="footer-bottom-links">
        <a href="page.php?slug=privacy-policy">Privacy Policy</a>
        <a href="page.php?slug=about-us">About Us</a>
        <a href="blog.php">Blog</a>
      </div>
    </div>
  </div>
</footer>

</body>
</html>

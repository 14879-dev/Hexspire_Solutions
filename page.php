<?php
require_once __DIR__ . '/api/track_visitor.php';
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
$currentPage = '';
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
  <link rel="icon" type="image/png" href="assets/images/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
</head>
<body class="has-site-header inner-page">

<!-- Animated Background -->
<div id="bg-canvas" aria-hidden="true">
  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>
  <div class="blob blob-3"></div>
  <div class="blob blob-4"></div>
</div>

<?php require_once __DIR__ . '/includes/nav.php'; ?>

<!-- Hero Section -->
<div class="inner-hero">
  <img src="assets/images/hero.webp" alt="" class="inner-hero-bg-img" aria-hidden="true">
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
<div class="container" style="padding-bottom:60px;padding-bottom:60px;text-align:center;">
  <a href="index.php" class="btn btn-outline" id="back-to-home-page-btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
    Back to Home
  </a>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

</body>
</html>

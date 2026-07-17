<?php
require_once __DIR__ . '/includes/db.php';
$db = getDB();

$slug = trim($_GET['slug'] ?? '');
if (!$slug) { header('Location: blog.php'); exit; }

$stmt = $db->prepare("SELECT * FROM hs_blog_posts WHERE slug=? AND is_published=1");
$stmt->execute([$slug]);
$post = $stmt->fetch();

if (!$post) { header('HTTP/1.0 404 Not Found'); ?>
<!DOCTYPE html><html><head><title>Post Not Found</title></head><body><h1>404 — Post Not Found</h1><a href="blog.php">Back to Blog</a></body></html>
<?php exit; }

$logoPath = $db->query("SELECT value FROM hs_settings WHERE `key`='logo_path'")->fetchColumn() ?: '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($post['title']) ?> — Hexspire Solutions Blog</title>
  <meta name="description" content="Read '<?= htmlspecialchars($post['title']) ?>' on the Hexspire Solutions Blog.">
  <link rel="canonical" href="https://hexspiresolutions.com/blog-detail.php?slug=<?= htmlspecialchars($slug) ?>">
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
    <a href="blog.php" class="inner-hero-label" style="text-decoration:none">← Back to Blog</a>
    <h1><?= htmlspecialchars($post['title']) ?></h1>
    <p><?= date('d F Y', strtotime($post['created_at'])) ?></p>
  </div>
</div>

<!-- Cover Image -->
<?php if ($post['image_path']): ?>
<div class="container" style="margin-top:40px">
  <img src="<?= htmlspecialchars($post['image_path']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" style="width:100%;max-height:420px;object-fit:cover;border-radius:16px">
</div>
<?php endif; ?>

<!-- Content -->
<div class="container">
  <div class="blog-detail-content">
    <?= $post['content'] ?>
  </div>
</div>

<!-- Back Link -->
<div class="container" style="padding-bottom:60px">
  <a href="blog.php" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 5 5 12 12 19"/></svg>
    Back to Blog
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

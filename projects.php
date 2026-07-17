<?php
require_once __DIR__ . '/includes/db.php';
$db = getDB();
$logoPath = $db->query("SELECT value FROM hs_settings WHERE `key`='logo_path'")->fetchColumn() ?: '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Projects — Hexspire Solutions | Web Dev & SEO Portfolio</title>
  <meta name="description" content="Explore the full portfolio of Hexspire Solutions — web development, SEO campaigns, management systems, and digital experiences built for clients across Pakistan and beyond.">
  <link rel="canonical" href="https://hexspiresolutions.com/projects.php">
  <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">
  <link rel="icon" type="image/png" href="assets/images/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
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
      <a href="projects.php" aria-current="page">Projects</a>
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
    <span class="inner-hero-label">Our Portfolio</span>
    <h1>All Projects</h1>
    <p>Web apps, SEO campaigns, management systems, and more &mdash; handcrafted for real results.</p>
  </div>
</div>

<!-- Projects Section -->
<section class="section" aria-label="All Projects">
  <div class="container">
    <div class="projects-filter fade-up" id="projects-filter">
      <!-- Built dynamically by main.js -->
    </div>
    <div class="projects-grid" id="projects-grid">
      <!-- Built dynamically by main.js -->
    </div>
    <div class="text-center" style="margin-top:60px;">
      <a href="index.php" class="btn btn-outline" id="back-home-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 5 5 12 12 19"/></svg>
        Back to Home
      </a>
    </div>
  </div>
</section>

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

<script src="assets/js/main.js?v=<?= time() ?>"></script>
</body>
</html>

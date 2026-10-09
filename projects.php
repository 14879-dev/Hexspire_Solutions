<?php
require_once __DIR__ . '/api/track_visitor.php';
require_once __DIR__ . '/includes/db.php';
$db = getDB();
$logoPath = $db->query("SELECT value FROM hs_settings WHERE `key`='logo_path'")->fetchColumn() ?: '';
$currentPage = 'projects';
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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600;1,800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
    <span class="inner-hero-label">Our Portfolio</span>
    <h1>All Projects</h1>
    <p>Web applications, SEO campaigns, digital marketing funnels, and Flutter mobile apps &mdash; handcrafted for real results.</p>
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
      <a href="index.php" class="btn btn-pill-primary" id="back-home-btn" style="padding:12px 32px;">
        Back to Home
      </a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
</body>
</html>

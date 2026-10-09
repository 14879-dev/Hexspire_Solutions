<?php
require_once __DIR__ . '/api/track_visitor.php';
require_once __DIR__ . '/includes/db.php';
$db = getDB();
$posts = $db->query("SELECT id, title, slug, image_path, created_at FROM hs_blog_posts WHERE is_published=1 ORDER BY created_at DESC")->fetchAll();
$logoPath = $db->query("SELECT value FROM hs_settings WHERE `key`='logo_path'")->fetchColumn() ?: '';
$currentPage = 'blog';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog — Hexspire Solutions | Web Dev & SEO Insights</title>
  <meta name="description" content="Read the latest insights, tips, and case studies from the Hexspire Solutions team on web development, SEO, and digital marketing.">
  <link rel="canonical" href="https://hexspiresolutions.com/blog.php">
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
    <span class="inner-hero-label">Insights &amp; Updates</span>
    <h1>The Hexspire Blog</h1>
    <p>Web development tips, SEO strategies, and digital marketing insights from our team of experts.</p>
  </div>
</div>

<!-- Blog Posts -->
<section class="section">
  <div class="container">
    <?php if (empty($posts)): ?>
      <p style="text-align:center;color:var(--text-muted);padding:60px 0">No blog posts published yet. Check back soon!</p>
    <?php else: ?>
      <div class="blog-grid">
        <?php foreach ($posts as $post): ?>
        <a href="blog-detail.php?slug=<?= htmlspecialchars($post['slug']) ?>" class="blog-card">
          <?php if ($post['image_path']): ?>
            <img class="blog-card-image" src="<?= htmlspecialchars($post['image_path']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" loading="lazy">
          <?php else: ?>
            <div class="blog-card-image-placeholder">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </div>
          <?php endif; ?>
          <div class="blog-card-body">
            <p class="blog-card-date"><?= date('d F Y', strtotime($post['created_at'])) ?></p>
            <h2 class="blog-card-title"><?= htmlspecialchars($post['title']) ?></h2>
            <span class="blog-card-read">
              Read More
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </span>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

</body>
</html>

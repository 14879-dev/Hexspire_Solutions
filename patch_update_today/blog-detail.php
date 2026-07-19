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
  </div>
</div>

<!-- Author / Meta Bar -->
<div class="container">
  <div class="blog-meta-bar">
    <div class="blog-meta-author">
      <img src="uploads/logo/default.svg" alt="Hexspire Solutions" class="blog-meta-logo">
      <div class="blog-meta-info">
        <span class="blog-meta-name"><?= htmlspecialchars($post['author'] ?? 'Hexspire Solutions') ?></span>
        <span class="blog-meta-date"><?= date('d F Y', strtotime($post['created_at'])) ?></span>
      </div>
    </div>
    <div class="blog-share-dropdown-container" style="position: relative;">
      <button class="btn btn-outline" id="share-toggle-btn" style="display: flex; align-items: center; gap: 8px; border-radius: 20px; padding: 6px 16px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>
        Share
      </button>
      <div class="share-dropdown-menu" id="share-dropdown-menu">
        <?php $shareUrl = 'https://hexspiresolutions.com/blog-detail.php?slug=' . urlencode($slug); ?>
        <a href="https://wa.me/?text=<?= urlencode($post['title'] . ' ' . $shareUrl) ?>" target="_blank" rel="noopener" class="share-dropdown-item share-wa">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
          WhatsApp
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($shareUrl) ?>" target="_blank" rel="noopener" class="share-dropdown-item share-fb">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          Facebook
        </a>
        <a href="https://twitter.com/intent/tweet?text=<?= urlencode($post['title']) ?>&url=<?= urlencode($shareUrl) ?>" target="_blank" rel="noopener" class="share-dropdown-item share-tw">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.213 5.567zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          X / Twitter
        </a>
        <button class="share-dropdown-item share-copy" id="copy-link-btn" aria-label="Copy link" title="Copy link">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
          Copy Link
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Cover Image -->
<?php if ($post['image_path']): ?>
<div class="container" style="margin-top:32px">
  <img src="<?= htmlspecialchars($post['image_path']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" style="width:100%;max-height:420px;object-fit:cover;border-radius:16px">
</div>
<?php endif; ?>

<!-- Content -->
<div class="container">
  <div class="blog-detail-content">
    <?= $post['content'] ?>
  </div>
</div>

<!-- Bottom Actions -->
<div class="container" style="padding-bottom:60px;display:flex;gap:16px;flex-wrap:wrap;align-items:center">
  <a href="blog.php" class="btn btn-primary" id="back-to-blog-btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 5 5 12 12 19"/></svg>
    Back to Blog
  </a>
  <a href="index.php" class="btn btn-outline" id="back-to-home-blog-detail-btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
    Back to Home
  </a>
</div>

<script>
document.getElementById('share-toggle-btn').addEventListener('click', function(e) {
  e.stopPropagation();
  document.getElementById('share-dropdown-menu').classList.toggle('active');
});

document.addEventListener('click', function(e) {
  const menu = document.getElementById('share-dropdown-menu');
  if (menu && menu.classList.contains('active') && !e.target.closest('.blog-share-dropdown-container')) {
    menu.classList.remove('active');
  }
});

document.getElementById('copy-link-btn').addEventListener('click', function() {
  navigator.clipboard.writeText(window.location.href).then(() => {
    const originalContent = this.innerHTML;
    this.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg> Copied!';
    this.style.color = '#0d6efd';
    setTimeout(() => { 
      this.innerHTML = originalContent; 
      this.style.color = ''; 
    }, 2000);
  });
});
</script>

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

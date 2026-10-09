<?php
/**
 * Hexspire Solutions — Shared Transparent Navbar Include
 * Blue Liquid Glass nav — no CTA buttons in header
 */
$currentPage = $currentPage ?? '';
?>
<header class="site-header" id="site-header" role="banner">
  <div class="container nav-inner">

    <!-- Brand / Logo -->
    <a href="index.php" class="nav-brand" id="nav-logo" aria-label="Hexspire Solutions Home">
      <?php if (!empty($logoPath)): ?>
        <img src="<?= htmlspecialchars($logoPath) ?>" alt="Hexspire Solutions Logo" loading="lazy">
      <?php else: ?>
        <div class="nav-brand-hex" aria-hidden="true">H</div>
        <span class="nav-brand-name">Hexspire<span class="nav-brand-dot">.</span></span>
      <?php endif; ?>
    </a>

    <!-- Desktop Navigation Links -->
    <nav class="nav-links" role="navigation" aria-label="Main Navigation">
      <a href="index.php" class="nav-link<?= $currentPage==='home' ? ' active' : '' ?>" id="nav-home">Home</a>
      <a href="services.php" class="nav-link<?= $currentPage==='services' ? ' active' : '' ?>" id="nav-services">Services</a>
      <a href="projects.php" class="nav-link<?= $currentPage==='projects' ? ' active' : '' ?>" id="nav-projects">Portfolio</a>
      <a href="about.php" class="nav-link<?= $currentPage==='about' ? ' active' : '' ?>" id="nav-about">About Us</a>
      <a href="blog.php" class="nav-link<?= $currentPage==='blog' ? ' active' : '' ?>" id="nav-blog">Blog</a>
      <a href="contact.php" class="nav-link<?= $currentPage==='contact' ? ' active' : '' ?>" id="nav-contact">Contact</a>
    </nav>

    <!-- Mobile Hamburger -->
    <button class="nav-hamburger" id="nav-hamburger" aria-label="Toggle menu" aria-expanded="false" aria-controls="nav-mobile-menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<!-- Mobile Drawer Backdrop Overlay -->
<div class="nav-mobile-backdrop" id="nav-mobile-backdrop" aria-hidden="true"></div>

<!-- Mobile Drawer Menu (Solid White, Animated Slide-in from Right) -->
<div class="nav-mobile-menu" id="nav-mobile-menu" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Mobile Navigation">
  <div class="nav-mobile-header">
    <div class="nav-mobile-brand">
      <div class="nav-brand-hex" style="background:#0E2F76;color:#F5FEFF;border:1px solid #AAC0E1;" aria-hidden="true">H</div>
      <span class="nav-mobile-brand-name">Hexspire<span style="color:#0E2F76;">.</span></span>
    </div>
    <button class="nav-mobile-close" id="nav-mobile-close" aria-label="Close navigation" type="button">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    </button>
  </div>

  <div class="nav-mobile-divider"></div>

  <div class="nav-mobile-links">
    <a href="index.php" class="nav-mobile-link<?= $currentPage==='home' ? ' active' : '' ?>">Home</a>
    <a href="services.php" class="nav-mobile-link<?= $currentPage==='services' ? ' active' : '' ?>">Services</a>
    <a href="projects.php" class="nav-mobile-link<?= $currentPage==='projects' ? ' active' : '' ?>">Portfolio</a>
    <a href="about.php" class="nav-mobile-link<?= $currentPage==='about' ? ' active' : '' ?>">About Us</a>
    <a href="blog.php" class="nav-mobile-link<?= $currentPage==='blog' ? ' active' : '' ?>">Blog</a>
    <a href="contact.php" class="nav-mobile-link<?= $currentPage==='contact' ? ' active' : '' ?>">Contact</a>
  </div>

  <div class="nav-mobile-footer">
    <a href="contact.php" class="btn btn-pill-primary nav-mobile-cta-btn">Get In Touch</a>
  </div>
</div>

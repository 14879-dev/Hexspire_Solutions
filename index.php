<?php
/**
 * Hexspire Solutions — Public Single-Page Marketing Site
 * Neo-Futuristic Studio Theme (Reference Design with Royal Blue Accents)
 */
require_once __DIR__ . '/api/track_visitor.php';
require_once __DIR__ . '/includes/db.php';
$db = getDB();
$logoPath = $db->query("SELECT value FROM hs_settings WHERE `key`='logo_path'")->fetchColumn() ?: '';
$currentPage = 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hexspire Solutions — Web Development, SEO, Digital Marketing &amp; Flutter Apps</title>
  <meta name="description" content="Hexspire Solutions is a full-service agency specializing in custom web development, high-impact SEO, ROI-driven digital marketing, and cross-platform Flutter mobile applications.">
  <meta name="keywords" content="web development, SEO Pakistan, digital marketing, Flutter apps, mobile development, software agency Peshawar, Hexspire Solutions">
  <meta name="author" content="Hexspire Solutions">
  <meta property="og:title" content="Hexspire Solutions — Web Dev, SEO, Digital Marketing &amp; Flutter Apps">
  <meta property="og:description" content="Custom web platforms, technical SEO, high-converting digital marketing, and Flutter apps built to scale.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://hexspiresolutions.com/">
  <meta name="twitter:card" content="summary_large_image">
  <link rel="canonical" href="https://hexspiresolutions.com/">
  <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">
  <link rel="icon" type="image/png" href="assets/images/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600;1,800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Structured Data Schema for SEO -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "ProfessionalService",
    "name": "Hexspire Solutions",
    "url": "https://hexspiresolutions.com",
    "logo": "https://hexspiresolutions.com/assets/images/favicon.png",
    "description": "Enterprise-grade web engineering, digital applications, and SEO optimization agency based in Peshawar, Pakistan.",
    "telephone": "+923131990804",
    "email": "hexspire.offical@gmail.com",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Peshawar",
      "addressRegion": "Khyber Pakhtunkhwa",
      "addressCountry": "PK"
    },
    "sameAs": [
      "https://www.linkedin.com/company/hexspire-solutions/",
      "https://www.facebook.com/share/1AHQaEmYoK/",
      "https://www.instagram.com/hexspire.solutions?mdxt=MXByMmhwaDdtdzlhbA=="
    ]
  }
  </script>
</head>
<body class="has-site-header">

<?php require_once __DIR__ . '/includes/nav.php'; ?>

<!-- ================================================================
     HERO SECTION: AUTHENTIC BANNER HERO (FULL-WIDTH NATURAL LAYOUT)
     ================================================================ -->
<section class="hero-stage hero-authentic" id="hero" aria-label="Hero Section">
  <div class="hero-bg-layer" aria-hidden="true">
    <img src="assets/images/hero.webp" alt="Hexspire Solutions Tech Banner" class="hero-bg-img" loading="eager">
    <div class="hero-bg-overlay"></div>
  </div>

  <div class="container hero-inner-content">
    <div class="hero-eyebrow fade-up">
      <span class="hero-dot"></span> Web Dev &middot; SEO &middot; Digital Marketing &middot; Flutter Apps
    </div>

    <h1 class="hero-title fade-up fade-up-delay-1">
      Custom Web, High-Ranking SEO,<br><span class="title-sub-accent">Digital Marketing &amp; Flutter Apps</span>
    </h1>

    <p class="hero-desc fade-up fade-up-delay-2">
      Hexspire Solutions is a full-service digital agency delivering high-performance web applications, ROI-driven digital marketing, top-tier SEO rankings, and cross-platform Flutter mobile apps built to scale.
    </p>

    <div class="hero-actions fade-up fade-up-delay-3">
      <a href="contact.php" class="btn btn-pill-primary" id="hero-btn-start">
        Get In Touch 
      </a>
      <a href="projects.php" class="btn btn-pill-outline" id="hero-btn-projects">
        View Projects 
      </a>
    </div>

    <!-- Royal Blue Floating Stats Dock Capsule -->
    <div class="hero-stats-dock fade-up fade-up-delay-4" id="hero-stats-dock">
      <div class="stats-dock-col">
        <span class="stats-dock-val">99.8%</span>
        <span class="stats-dock-lbl">Uptime</span>
      </div>
      <div class="stats-dock-sep" aria-hidden="true"></div>
      <div class="stats-dock-col">
        <span class="stats-dock-val">50+</span>
        <span class="stats-dock-lbl">Delivered Projects</span>
      </div>
      <div class="stats-dock-sep" aria-hidden="true"></div>
      <div class="stats-dock-col">
        <span class="stats-dock-val">24/7</span>
        <span class="stats-dock-lbl">Engineering</span>
      </div>
    </div>
  </div>
</section>

<!-- ================================================================
     TECH STACK TICKER / TRUSTED ECOSYSTEM
     ================================================================ -->
<div class="tech-ticker-wrap" aria-label="Technology Stack">
  <div class="tech-ticker-track">
    <div class="tech-ticker-pill">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
      PHP 8+ Engineering
    </div>
    <div class="tech-ticker-pill">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg>
      MySQL &amp; Relational Architecture
    </div>
    <div class="tech-ticker-pill">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
      Flutter &amp; Dart Mobile
    </div>
    <div class="tech-ticker-pill">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
      React &amp; Modern UI/UX
    </div>
    <div class="tech-ticker-pill">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      Technical SEO &amp; Core Web Vitals
    </div>
    <div class="tech-ticker-pill">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      Cloudflare &amp; DDoS Security
    </div>
    <div class="tech-ticker-pill">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
      Sub-Second Page Load SLAs
    </div>

    <!-- Duplicate for infinite marquee loop -->
    <div class="tech-ticker-pill">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
      PHP 8+ Engineering
    </div>
    <div class="tech-ticker-pill">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg>
      MySQL &amp; Relational Architecture
    </div>
    <div class="tech-ticker-pill">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
      Flutter &amp; Dart Mobile
    </div>
    <div class="tech-ticker-pill">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
      React &amp; Modern UI/UX
    </div>
  </div>
</div>

<!-- ================================================================
     SECTION 2: GATEWAY CARDS — EXPLORE THE ECOSYSTEM
     ================================================================ -->
<section class="gateway-section" aria-label="Explore Hexspire Ecosystem" style="padding:48px 0;">
  <div class="container">
    <div class="text-center" style="max-width:680px;margin:0 auto 36px;">
      <span class="hero-eyebrow fade-up" style="color:var(--primary);margin-bottom:12px;">Core Ecosystem</span>
      <h2 style="font-family:'Space Grotesk','Outfit',sans-serif;font-size:clamp(1.9rem,3.6vw,2.8rem);font-weight:800;letter-spacing:-0.02em;margin-bottom:14px;color:#0f172a;" class="fade-up fade-up-delay-1">
        Everything Engineered for Your Success
      </h2>
      <p style="color:var(--text-secondary);font-size:1.02rem;line-height:1.7;" class="fade-up fade-up-delay-2">
        From deep custom software engineering to data-backed organic rankings, explore the pillars of what makes Hexspire Peshawar's premier digital agency.
      </p>
    </div>
    <div class="gateway-grid">

      <!-- Services Card -->
      <a href="services.php" class="gateway-card fade-up" id="gateway-services">
        <div class="gateway-card-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
        </div>
        <div class="gateway-card-title">Our Services</div>
        <p class="gateway-card-desc">Bespoke web apps, technical SEO, WordPress platforms, digital marketing, and mobile applications with 90+ PageSpeed benchmarks.</p>
        <span class="gateway-card-link">
          Explore Services 
        </span>
      </a>

      <!-- Portfolio Card -->
      <a href="projects.php" class="gateway-card fade-up fade-up-delay-1" id="gateway-projects">
        <div class="gateway-card-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        </div>
        <div class="gateway-card-title">Our Portfolio</div>
        <p class="gateway-card-desc">Inspect real enterprise web apps, management software, and high-converting e-commerce stores we've engineered for clients.</p>
        <span class="gateway-card-link">
          View Portfolio 
        </span>
      </a>

      <!-- Team Card -->
      <a href="about.php" class="gateway-card fade-up fade-up-delay-2" id="gateway-about">
        <div class="gateway-card-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div class="gateway-card-title">Meet the Team</div>
        <p class="gateway-card-desc">Passionate full-stack developers, SEO strategists, and UI/UX designers dedicated to building digital tools that win in the real world.</p>
        <span class="gateway-card-link">
          About Us 
        </span>
      </a>

    </div>
  </div>
</section>

<!-- ================================================================
     SECTION 3: ENGINEERING PILLARS / VALUE PROPOSITIONS
     ================================================================ -->
<section style="background:#ffffff;padding:44px 0;border-top:1px solid rgba(226,232,240,0.8);border-bottom:1px solid rgba(226,232,240,0.8);" aria-label="Why Choose Us">
  <div class="container">
    <div class="text-center" style="max-width:680px;margin:0 auto 36px;">
      <span class="hero-eyebrow fade-up" style="color:var(--primary);margin-bottom:12px;">Quality Guarantee</span>
      <h2 style="font-family:'Space Grotesk','Outfit',sans-serif;font-size:clamp(1.9rem,3.6vw,2.8rem);font-weight:800;letter-spacing:-0.02em;margin-bottom:14px;color:#0f172a;" class="fade-up fade-up-delay-1">
        Engineered for Extreme Velocity &amp; Uptime
      </h2>
      <p style="color:var(--text-secondary);font-size:1.02rem;line-height:1.7;" class="fade-up fade-up-delay-2">
        We hold every deployment to rigorous standards to ensure your digital platform scales without bottlenecks.
      </p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:24px;">
      
      <div style="background:#f8fafc;border:1px solid rgba(226,232,240,0.85);border-radius:24px;padding:34px 28px;transition:transform 0.3s ease,box-shadow 0.3s ease;" class="fade-up">
        <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#0d6efd,#0052cc);color:#fff;display:flex;align-items:center;justify-content:center;margin-bottom:20px;box-shadow:0 8px 20px rgba(13,110,253,0.3);">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="22" height="22" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
        </div>
        <h3 style="font-family:'Space Grotesk',sans-serif;font-size:1.25rem;font-weight:700;color:#0f172a;margin-bottom:10px;">Sub-Second Latency</h3>
        <p style="color:var(--text-secondary);font-size:0.92rem;line-height:1.65;margin:0;">Optimized backend queries, browser caching, and responsive frontend bundles delivering 90+ Core Web Vitals on mobile and desktop.</p>
      </div>

      <div style="background:#f8fafc;border:1px solid rgba(226,232,240,0.85);border-radius:24px;padding:34px 28px;transition:transform 0.3s ease,box-shadow 0.3s ease;" class="fade-up fade-up-delay-1">
        <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#0d6efd,#0052cc);color:#fff;display:flex;align-items:center;justify-content:center;margin-bottom:20px;box-shadow:0 8px 20px rgba(13,110,253,0.3);">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="22" height="22" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h3 style="font-family:'Space Grotesk',sans-serif;font-size:1.25rem;font-weight:700;color:#0f172a;margin-bottom:10px;">Defensive Architecture</h3>
        <p style="color:var(--text-secondary);font-size:0.92rem;line-height:1.65;margin:0;">Built-in parameterized database queries, CSRF token defenses, input sanitization, and Cloudflare WAF protection against DDoS attacks.</p>
      </div>

      <div style="background:#f8fafc;border:1px solid rgba(226,232,240,0.85);border-radius:24px;padding:34px 28px;transition:transform 0.3s ease,box-shadow 0.3s ease;" class="fade-up fade-up-delay-2">
        <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#0d6efd,#0052cc);color:#fff;display:flex;align-items:center;justify-content:center;margin-bottom:20px;box-shadow:0 8px 20px rgba(13,110,253,0.3);">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="22" height="22" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </div>
        <h3 style="font-family:'Space Grotesk',sans-serif;font-size:1.25rem;font-weight:700;color:#0f172a;margin-bottom:10px;">Rank-Ready Organic SEO</h3>
        <p style="color:var(--text-secondary);font-size:0.92rem;line-height:1.65;margin:0;">Rich JSON-LD Schema markup, structured semantic HTML5, crawl efficiency tuning, and commercial keyword targeting built right in.</p>
      </div>

      <div style="background:#f8fafc;border:1px solid rgba(226,232,240,0.85);border-radius:24px;padding:34px 28px;transition:transform 0.3s ease,box-shadow 0.3s ease;" class="fade-up fade-up-delay-3">
        <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#0d6efd,#0052cc);color:#fff;display:flex;align-items:center;justify-content:center;margin-bottom:20px;box-shadow:0 8px 20px rgba(13,110,253,0.3);">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="22" height="22" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <h3 style="font-family:'Space Grotesk',sans-serif;font-size:1.25rem;font-weight:700;color:#0f172a;margin-bottom:10px;">Continuous Reliability</h3>
        <p style="color:var(--text-secondary);font-size:0.92rem;line-height:1.65;margin:0;">24/7 uptime monitoring, automated remote database backups, SSL lifecycle management, and prompt technical support.</p>
      </div>

    </div>
  </div>
</section>

<!-- ================================================================
     SECTION 4: FINAL CALL TO ACTION
     ================================================================ -->
<section class="section home-cta-section" aria-label="Get Started" style="background:#AAC0E1;color:#0E2F76;padding:48px 0;text-align:center;position:relative;overflow:hidden;border-top:1.5px solid rgba(14,47,118,0.15);">
  <div class="container" style="position:relative;z-index:2;max-width:760px;">
    <span class="hero-eyebrow fade-up" style="color:#0E2F76;background:rgba(14,47,118,0.12);border-color:rgba(14,47,118,0.25);margin-bottom:14px;">Ready to Scale?</span>
    <h2 style="font-family:var(--font-display);font-size:clamp(2rem,4vw,2.8rem);font-weight:800;letter-spacing:-0.02em;margin-bottom:16px;color:#0E2F76;" class="fade-up fade-up-delay-1">
      Let's Build Something Extraordinary Together
    </h2>
    <p style="color:#173874;font-size:1.05rem;line-height:1.7;margin-bottom:28px;" class="fade-up fade-up-delay-2">
      Whether you need an enterprise web application, high-converting digital platform, or a dominant organic search ranking, our team in Peshawar is ready to turn your goals into measurable reality.
    </p>
    <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;" class="fade-up fade-up-delay-3">
      <a href="contact.php" class="btn btn-pill-primary" style="padding:14px 34px;font-size:1rem;background:#0E2F76 !important;color:#F5FEFF !important;border:1.5px solid #0E2F76 !important;">
        Contact Our Team 
      </a>
      <a href="services.php" class="btn btn-pill-outline btn-pill-outline-light-bg" style="padding:14px 28px;font-size:1rem;color:#0E2F76 !important;border:1.5px solid #0E2F76 !important;background:transparent !important;text-decoration:none;">
        Explore All Services
      </a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
</body>
</html>

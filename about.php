<?php
/**
 * Hexspire Solutions â€” Detailed About Us Page
 */
require_once __DIR__ . '/api/track_visitor.php';
require_once __DIR__ . '/includes/db.php';
$db = getDB();
$logoPath = $db->query("SELECT value FROM hs_settings WHERE `key`='logo_path'")->fetchColumn() ?: '';
$currentPage = 'about';

// Fetch team members if table exists
$team = [];
try {
    $team = $db->query("SELECT * FROM hs_team ORDER BY sort_order ASC, id ASC")->fetchAll();
} catch (\Exception $e) {
    $team = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us â€” Hexspire Solutions | Web Development &amp; SEO Agency</title>
  <meta name="description" content="Discover the story, mission, and passionate team behind Hexspire Solutions â€” Peshawar's premier web development and data-driven SEO powerhouse.">
  <link rel="canonical" href="https://hexspiresolutions.com/about.php">
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
<div class="inner-hero about-inner-hero">
  <img src="assets/images/hero.webp" alt="Hexspire Solutions" class="inner-hero-bg-img" aria-hidden="true">
  <div class="inner-hero-overlay"></div>
  <div class="container">
    <span class="inner-hero-label">Who We Are &middot; Hexspire Solutions</span>
    <h1>About Us</h1>
    <p class="about-hero-desc">
     We help startups and forward-thinking businesses grow with custom web apps, SEO, digital marketing, and high-performance Flutter mobile solutions.
    </p>
    <div class="about-hero-btns">
      <a href="projects.php" class="btn btn-pill-primary">
        Explore Our Work
      </a>
      <a href="contact.php" class="btn btn-pill-outline btn-pill-outline-dark" style="color:#F5FEFF;border-color:#AAC0E1;">
        Get In Touch
      </a>
    </div>
  </div>
</div>

<!-- Stats Bar -->
<section class="about-stats-section" style="background:#fff;border-bottom:1px solid var(--bg-700);padding:32px 0;">
  <div class="container">
    <div class="about-stats-grid">
      <div class="about-stat-item">
        <div class="about-stat-val">50+</div>
        <div class="about-stat-lbl">Delivered Projects</div>
      </div>
      <div class="about-stat-item">
        <div class="about-stat-val">99.8%</div>
        <div class="about-stat-lbl">Client Satisfaction</div>
      </div>
      <div class="about-stat-item">
        <div class="about-stat-val">100%</div>
        <div class="about-stat-lbl">On-Time Milestones</div>
      </div>
      <div class="about-stat-item">
        <div class="about-stat-val">24/7</div>
        <div class="about-stat-lbl">Dedicated Support</div>
      </div>
    </div>
  </div>
</section>

<!-- Company Story Section -->
<section class="section" aria-label="Our Story" style="padding:44px 0;">
  <div class="container" style="max-width:860px;margin:0 auto;">
    <div class="text-center" style="margin-bottom:30px;">
      <span class="section-label">Our Story</span>
      <h2 class="section-title" style="margin-bottom:16px;">Rooted in Peshawar, Built for the Global Digital Economy</h2>
    </div>

    <div style="color:var(--text-secondary);font-size:1.05rem;line-height:1.85;">
      <p style="margin-bottom:16px;">
        Hexspire Solutions began with a singular, resolute conviction: businesses deserve digital tools engineered with uncompromising quality, not fragile templates stitched together with bloatware.
      </p>
      <p style="margin-bottom:16px;">
        From our headquarters in Peshawar, Khyber Pakhtunkhwa, we assembled a collective of seasoned software engineers, UI/UX designers, and search algorithm specialists. We bridged the gap between sophisticated technical architecture and measurable commercial outcomes.
      </p>
      <p style="margin-bottom:22px;">
        Today, whether we are deploying a modern enterprise web application, revamping an e-commerce storefront, or orchestrating a full-scale organic ranking takeover, our methodology remains identical: deep technical precision, total transparency, and unwavering focus on your ROI.
      </p>

      <div style="padding:22px 26px;border-left:4px solid var(--primary);background:var(--primary-glow-sm);border-radius:0 16px 16px 0;margin-top:14px;">
        <p style="margin:0;font-style:italic;color:var(--text-primary);font-weight:500;font-size:1.02rem;">
          &ldquo;We don't merely write lines of code; we build the digital foundation upon which businesses thrive, scale, and outperform their competition.&rdquo;
        </p>
        <span style="display:block;margin-top:8px;font-size:0.9rem;color:var(--primary);font-weight:700;">— Hexspire Leadership Team</span>
      </div>
    </div>
  </div>
</section>

<!-- Mission & Vision Section -->
<section style="background:var(--bg-50);padding:44px 0;border-top:1px solid var(--bg-700);border-bottom:1px solid var(--bg-700);">
  <div class="container">
    <div class="text-center" style="max-width:680px;margin:0 auto 48px;">
      <span class="section-label">Our North Star</span>
      <h2 class="section-title">Mission &amp; Vision</h2>
      <p class="section-sub">Guiding principles that drive every line of code we ship and every strategy we formulate.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:32px;">
      <!-- Mission Card -->
      <div style="background:#fff;border:1px solid var(--bg-700);border-radius:20px;padding:40px;box-shadow:var(--shadow-sm);position:relative;overflow:hidden;">
        <div style="position:absolute;top:0;left:0;right:0;height:4px;background:var(--primary);"></div>
        <div class="value-icon" style="margin:0 0 20px 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>
        </div>
        <h3 style="font-size:1.4rem;font-weight:800;margin-bottom:14px;">Our Mission</h3>
        <p style="color:var(--text-secondary);line-height:1.8;font-size:0.95rem;">
          To empower ambitious startups, enterprises, and local businesses with resilient digital infrastructure, bespoke web engineering, and transparent, high-ROI search optimization that delivers measurable market advantage and sustainable growth.
        </p>
      </div>

      <!-- Vision Card -->
      <div style="background:#fff;border:1px solid var(--bg-700);border-radius:20px;padding:40px;box-shadow:var(--shadow-sm);position:relative;overflow:hidden;">
        <div style="position:absolute;top:0;left:0;right:0;height:4px;background:#06b6d4;"></div>
        <div class="value-icon" style="margin:0 0 20px 0;background:rgba(6,182,212,0.1);border-color:rgba(6,182,212,0.2);">
          <svg viewBox="0 0 24 24" fill="none" stroke="#06b6d4"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
        </div>
        <h3 style="font-size:1.4rem;font-weight:800;margin-bottom:14px;">Our Vision</h3>
        <p style="color:var(--text-secondary);line-height:1.8;font-size:0.95rem;">
          To establish Hexspire Solutions as the premier digital transformation powerhouse in Khyber Pakhtunkhwa and across Pakistan, recognized internationally for engineering excellence, design elegance, and unrelenting client commitment.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Core Values Section -->
<section class="section" aria-label="Core Values">
  <div class="container">
    <div class="text-center" style="max-width:680px;margin:0 auto 16px;">
      <span class="section-label">What Drives Us</span>
      <h2 class="section-title">Our Core Values</h2>
      <p class="section-sub">These foundational pillars shape our code, our culture, and our long-term client partnerships.</p>
    </div>

    <div class="values-grid">
      <!-- 1 -->
      <div class="value-card">
        <div class="value-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
        </div>
        <h3>Engineering Rigor</h3>
        <p>Zero compromises on clean, modular, and maintainable code. We write software built to scale smoothly for years to come.</p>
      </div>

      <!-- 2 -->
      <div class="value-card">
        <div class="value-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
        </div>
        <h3>Radical Transparency</h3>
        <p>No cryptic buzzwords or hidden fees. Transparent milestones, honest progress reports, and direct communication every step.</p>
      </div>

      <!-- 3 -->
      <div class="value-card">
        <div class="value-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        </div>
        <h3>Pixel &amp; Speed Obsession</h3>
        <p>We craft fluid UI/UX interfaces that render instantly, achieve 90+ Core Web Vitals, and captivate your audience immediately.</p>
      </div>

      <!-- 4 -->
      <div class="value-card">
        <div class="value-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <h3>Partnership Mindset</h3>
        <p>We don't act as detached contractors. We treat your digital product with the same dedication as if it were our own startup.</p>
      </div>

      <!-- 5 -->
      <div class="value-card">
        <div class="value-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </div>
        <h3>Security &amp; Stability</h3>
        <p>Defensive architecture by design â€” CSRF protection, SQL prevention, automated backups, and encrypted transmissions.</p>
      </div>

      <!-- 6 -->
      <div class="value-card">
        <div class="value-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
        </div>
        <h3>Data-Driven Growth</h3>
        <p>Every design choice and SEO optimization is rooted in tangible analytics, user heatmaps, and empirical search queries.</p>
      </div>
    </div>
  </div>
</section>



<!-- Team Section -->
<section class="section" aria-label="Our Team" id="team">
  <div class="container">
    <div class="text-center" style="max-width:680px;margin:0 auto 56px;">
      <span class="section-label">The People Behind the Code</span>
      <h2 class="section-title">Meet Our Team</h2>
      <p class="section-sub">A tight-knit crew of creators, developers, and strategists obsessed with digital perfection.</p>
    </div>

    <div class="team-cards-grid">
      <?php
      // Normalise: API uses photo_path, direct query may use image_path
      $displayTeam = $team;
      if (empty($displayTeam)) {
          // Hardcoded fallback team if DB is unreachable
          $displayTeam = [
              ['name'=>'Hexspire Team', 'role'=>'Full-Stack & Architecture', 'bio'=>'Leading high-performance software engineering, cloud infrastructures, and database design.', 'photo_path'=>'', 'image_path'=>'', 'linkedin'=>'https://www.linkedin.com/company/hexspire-solutions/', 'github'=>'', 'twitter'=>''],
              ['name'=>'SEO Division', 'role'=>'Search Strategy & Analytics', 'bio'=>'Specialists in technical audits, keyword expansion, and high-impact link acquisition.', 'photo_path'=>'', 'image_path'=>'', 'linkedin'=>'https://www.linkedin.com/company/hexspire-solutions/', 'github'=>'', 'twitter'=>''],
              ['name'=>'UI/UX Team', 'role'=>'Product & Visual Design', 'bio'=>'Crafting intuitive user journeys and design systems that convert visitors into loyal customers.', 'photo_path'=>'', 'image_path'=>'', 'linkedin'=>'https://www.linkedin.com/company/hexspire-solutions/', 'github'=>'', 'twitter'=>''],
          ];
      }
      foreach ($displayTeam as $i => $member):
          $photo = !empty($member['photo_path']) ? $member['photo_path'] : ($member['image_path'] ?? '');
          $name  = htmlspecialchars($member['name'] ?? '');
          $role  = htmlspecialchars($member['role'] ?? '');
          $bio   = htmlspecialchars($member['bio']  ?? '');
          $linkedin = htmlspecialchars($member['linkedin'] ?? '');
          $github   = htmlspecialchars($member['github']   ?? '');
          $twitter  = htmlspecialchars($member['twitter']  ?? '');
          $initials = strtoupper(substr($name, 0, 1));
          $gradients = [
              'linear-gradient(135deg,#0E2F76,#153e96)',
              'linear-gradient(135deg,#0E2F76,#AAC0E1)',
              'linear-gradient(135deg,#153e96,#0E2F76)',
          ];
          $grad = $gradients[$i % count($gradients)];
      ?>
      <div class="team-member-card">
        <!-- Photo -->
        <div class="team-member-photo-wrap">
          <?php if ($photo): ?>
            <img src="<?= $photo ?>" alt="<?= $name ?>" class="team-member-photo" loading="lazy">
          <?php else: ?>
            <div class="team-member-avatar" style="background:<?= $grad ?>">
              <?= $initials ?>
            </div>
          <?php endif; ?>
          <!-- Social overlay -->
          <div class="team-member-social-overlay">
            <?php if ($linkedin): ?>
            <a href="<?= $linkedin ?>" target="_blank" rel="noopener noreferrer" class="team-social-btn team-social-linkedin" aria-label="LinkedIn">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            </a>
            <?php endif; ?>
            <?php if ($github): ?>
            <a href="<?= $github ?>" target="_blank" rel="noopener noreferrer" class="team-social-btn team-social-github" aria-label="GitHub">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0 1 12 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
            </a>
            <?php endif; ?>
            <?php if ($twitter): ?>
            <a href="<?= $twitter ?>" target="_blank" rel="noopener noreferrer" class="team-social-btn team-social-twitter" aria-label="Twitter / X">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.748l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            </a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Info -->
        <div class="team-member-info">
          <h3 class="team-member-name"><?= $name ?></h3>
          <p class="team-member-role"><?= $role ?></p>
          <?php if ($bio): ?>
          <p class="team-member-bio"><?= $bio ?></p>
          <?php endif; ?>
          <!-- Bottom social links row -->
          <div class="team-member-links">
            <?php if ($linkedin): ?>
            <a href="<?= $linkedin ?>" target="_blank" rel="noopener noreferrer" class="team-link team-link-linkedin" aria-label="LinkedIn profile">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
              LinkedIn
            </a>
            <?php endif; ?>
            <?php if ($github): ?>
            <a href="<?= $github ?>" target="_blank" rel="noopener noreferrer" class="team-link team-link-github" aria-label="GitHub profile">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0 1 12 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
              GitHub
            </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Call to Action -->
<section class="about-cta-section" style="background:#AAC0E1;padding:48px 0;color:#0E2F76;text-align:center;position:relative;overflow:hidden;border-top:1.5px solid rgba(14,47,118,0.15);">
  <div class="container" style="position:relative;z-index:1;max-width:720px;">
    <span class="hero-badge" style="background:rgba(14,47,118,0.12);color:#0E2F76;border:1px solid rgba(14,47,118,0.25);display:inline-flex;margin-bottom:16px;">
      <span class="dot" style="background:#0E2F76;"></span>
      Let's Build Together
    </span>
    <h2 style="font-family:var(--font-display);font-size:clamp(2rem,4vw,3.2rem);font-weight:800;margin-bottom:16px;color:#0E2F76;line-height:1.2;">
      Ready to elevate your digital presence?
    </h2>
    <p style="color:#173874;font-size:1.05rem;line-height:1.75;margin-bottom:28px;">
      Tell us about your project vision, timeline, and goals. We'll provide a transparent roadmap and competitive proposal within 24 hours.
    </p>
    <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
      <a href="contact.php" class="btn btn-pill-primary" style="padding:14px 34px;font-size:1rem;background:#0E2F76 !important;color:#F5FEFF !important;border:1.5px solid #0E2F76 !important;">
        Start a Conversation
      </a>
      <a href="services.php" class="btn btn-pill-outline btn-pill-outline-light-bg" style="border:1.5px solid #0E2F76 !important;color:#0E2F76 !important;background:transparent !important;padding:14px 28px;text-decoration:none;">
        Explore All Services
      </a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

</body>
</html>

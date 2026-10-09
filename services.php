<?php
/**
 * Hexspire Solutions — Detailed Services Page
 * Connected dynamically to Admin Panel (hs_services) with uploaded images
 */
require_once __DIR__ . '/api/track_visitor.php';
require_once __DIR__ . '/includes/db.php';
$db = getDB();
$logoPath = $db->query("SELECT value FROM hs_settings WHERE `key`='logo_path'")->fetchColumn() ?: '';
$currentPage = 'services';

// Fetch dynamic services from database
$services = [];
try {
    $services = $db->query("SELECT * FROM hs_services ORDER BY sort_order ASC, id ASC")->fetchAll();
} catch (\Exception $e) {
    $services = [];
}

// Fallback services if database is unreachable or table is empty
if (empty($services)) {
    $services = [
        [
            'id' => 1,
            'icon' => 'code',
            'title' => 'Web Development',
            'description' => 'We craft blazing-fast, responsive websites and web applications tailored to your business goals — from landing pages to full-scale platforms.',
            'image_path' => 'uploads/services/1784709248_1784462068_ChatGPTImageJul19202604_46_26PM.webp'
        ],
        [
            'id' => 2,
            'icon' => 'search',
            'title' => 'SEO Optimization',
            'description' => 'Dominate search rankings with our data-driven SEO strategies — technical audits, keyword research, on-page optimization, and link building.',
            'image_path' => 'uploads/services/1784709279_1784462205_ChatGPTImageJul19202604_56_25PM.webp'
        ],
        [
            'id' => 3,
            'icon' => 'globe',
            'title' => 'WordPress',
            'description' => 'Custom WordPress websites designed for performance, security, SEO, and easy content management, helping your business establish a strong online presence.',
            'image_path' => 'uploads/services/1784709236_1784462143_ChatGPTImageJul19202604_55_18PM.webp'
        ],
        [
            'id' => 4,
            'icon' => 'bar-chart-2',
            'title' => 'Digital Marketing',
            'description' => 'Grow your brand with targeted digital marketing campaigns — social media, PPC, content strategy, and conversion-rate optimization.',
            'image_path' => 'uploads/services/1784709294_1784462152_ChatGPTImageJul19202604_55_24PM.webp'
        ],
        [
            'id' => 6,
            'icon' => 'layout',
            'title' => 'UI/UX Design',
            'description' => 'We create intuitive, engaging, and accessible user interfaces that deliver exceptional digital experiences and drive customer satisfaction.',
            'image_path' => 'uploads/services/1784709308_1784462551_ChatGPTImageJul19202605_02_15PM.webp'
        ],
        [
            'id' => 7,
            'icon' => 'smartphone',
            'title' => 'App Development',
            'description' => 'Build fast, beautiful, and scalable Flutter apps for Android and iOS with a single codebase, delivering seamless performance and exceptional user experiences.',
            'image_path' => 'uploads/services/1784709268_1784463283_ChatGPTImageJul19202605_14_03PM.webp'
        ]
    ];
}

// Preset feature sets and tags for key known services
$serviceHighlights = [
    'Web Development' => [
        'tag' => 'Full-Stack Engineering',
        'tech' => 'PHP · Node.js · React · MySQL · Cloud',
        'features' => [
            'Custom frontend & backend architecture tailored precisely to your operational workflow',
            'Optimized performance achieving 90+ Google PageSpeed and Core Web Vitals benchmarks',
            'Built-in defensive security: SQL injection prevention, CSRF tokens, and sanitized inputs',
            'Seamless REST API integrations with third-party CRM, ERP, and payment systems'
        ],
        'cta' => 'Request Web Dev Proposal'
    ],
    'SEO Optimization' => [
        'tag' => 'Organic Search Authority',
        'tech' => 'Technical SEO · Schema · High Intent Keywords',
        'features' => [
            'Complete technical audits identifying crawl errors, canonical mismatches & render bottlenecks',
            'High-intent commercial keyword mapping with content cluster optimization',
            'Rich Schema markup implementation (Organization, LocalBusiness, Service, FAQ, Product)',
            'Local SEO dominance via Google Business Profile optimization & geo-targeted landing pages'
        ],
        'cta' => 'Get a Free SEO Audit'
    ],
    'WordPress' => [
        'tag' => 'CMS Architecture & Speed',
        'tech' => 'Custom Themes · WooCommerce · ACF Pro · Speed',
        'features' => [
            'Bespoke lightweight theme & block development without sluggish, bloated page builders',
            'Seamless WooCommerce stores with tailored checkout funnels and payment integration',
            'Hardened security configuration, automated scheduled backups, and malware protection',
            'High-speed object caching, image compression, and CDN integration for instant page loads'
        ],
        'cta' => 'Build Your WordPress Site'
    ],
    'Digital Marketing' => [
        'tag' => 'Growth & Acquisition',
        'tech' => 'Meta Ads · Google Ads · CRO · ROI Tracking',
        'features' => [
            'High-ROI paid advertising campaigns across Meta, Google Search, Display, and LinkedIn',
            'Conversion Rate Optimization (CRO) with heatmaps and A/B split testing funnels',
            'Multi-platform content marketing strategies designed to convert cold audiences into loyal clients',
            'Detailed analytics dashboards tracking ROAS, customer acquisition costs, and revenue growth'
        ],
        'cta' => 'Scale Your Marketing'
    ],
    'UI/UX Design' => [
        'tag' => 'Human-Centric Experience',
        'tech' => 'Figma · Design Systems · UX Research · Wireframes',
        'features' => [
            'Comprehensive user journey mapping, persona research, and frictionless wireframe flows',
            'Pixel-perfect interactive Figma prototypes with complete design system component tokens',
            'Accessibility-first standards (WCAG 2.1 AA) ensuring high legibility and usability across all devices',
            'Micro-interaction and motion design that elevates user delight and conversion velocity'
        ],
        'cta' => 'Start UI/UX Consultation'
    ],
    'App Development' => [
        'tag' => 'Cross-Platform Mobility',
        'tech' => 'Flutter · Dart · React Native · iOS & Android',
        'features' => [
            'Single codebase deployment for Google Play Store and Apple App Store',
            'Native 60fps performance with smooth gesture controls and responsive screen scaling',
            'Offline-first architecture with SQLite caching and background synchronization',
            'Push notification systems, biometrics, hardware camera, and sensor integrations'
        ],
        'cta' => 'Discuss Your Mobile App'
    ]
];

function renderServiceIcon($icon) {
    switch ($icon) {
        case 'code':
            return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="18" height="18" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>';
        case 'search':
            return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="18" height="18" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>';
        case 'globe':
            return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="18" height="18" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>';
        case 'bar-chart-2':
            return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="18" height="18" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>';
        case 'layout':
            return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="18" height="18" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>';
        case 'smartphone':
            return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="18" height="18" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>';
        default:
            return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="18" height="18" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Our Services — Hexspire Solutions | Web Engineering &amp; SEO Agency</title>
  <meta name="description" content="Explore our full spectrum of digital services: bespoke web development, high-converting e-commerce, technical SEO, mobile applications, and 24/7 cloud maintenance.">
  <link rel="canonical" href="https://hexspiresolutions.com/services.php">
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

<!-- Hero Section (Matching Inner Hero Banner) -->
<div class="inner-hero">
  <img src="assets/images/hero.webp" alt="Hexspire Solutions" class="inner-hero-bg-img" aria-hidden="true">
  <div class="inner-hero-overlay"></div>
  <div class="container">
    <span class="inner-hero-label">Our Capabilities &middot; Hexspire Solutions</span>
    <h1>Services</h1>
    <p>
      From custom enterprise web engineering and data-driven SEO audits to high-ROI digital marketing and cross-platform Flutter mobile applications, we provide end-to-end digital mastery tailored to scale your brand.
    </p>
  </div>
</div>

<!-- Service Category Quick-Jump Bar -->
<div class="services-quicknav-bar" style="background:#ffffff;border-bottom:1px solid var(--bg-700);padding:14px 0;position:sticky;top:70px;z-index:90;">
  <div class="container" style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
    <?php foreach ($services as $svc): 
      $slug = preg_replace('/[^a-z0-9]+/', '-', strtolower($svc['title'] ?? ''));
    ?>
      <a href="#<?= $slug ?>" class="btn-pill-outline" style="padding:7px 16px;font-size:0.82rem;"><?= htmlspecialchars($svc['title']) ?></a>
    <?php endforeach; ?>
  </div>
</div>

<!-- Detailed Service Blocks (Connected to Admin Panel) -->
<section class="section" aria-label="Detailed Services">
  <div class="container">

    <?php foreach ($services as $idx => $svc): 
        $title = htmlspecialchars($svc['title'] ?? '');
        $desc  = htmlspecialchars($svc['description'] ?? '');
        $icon  = $svc['icon'] ?? 'zap';
        $image = !empty($svc['image_path']) ? htmlspecialchars($svc['image_path']) : '';
        $slug  = preg_replace('/[^a-z0-9]+/', '-', strtolower($svc['title'] ?? 'service-' . $idx));
        $isReverse = ($idx % 2 === 1) ? 'reverse' : '';

        $highlight = $serviceHighlights[$svc['title']] ?? [
            'tag' => 'Specialized Capability',
            'tech' => 'Tailored Digital Solutions · Hexspire',
            'features' => [
                'Bespoke architecture tailored precisely to your unique organizational goals',
                'Rigorous quality assurance, clean maintainable code, and high-performance execution',
                'Comprehensive security, sanitized endpoints, and defensive engineering practices',
                'Full documentation, seamless deployment, and continuous technical support'
            ],
            'cta' => 'Request Proposal'
        ];
    ?>
    <div class="service-detail-block <?= $isReverse ?>" id="<?= $slug ?>">
      <div class="service-detail-content">
        <span class="service-tag">
          <?= renderServiceIcon($icon) ?>
          <?= htmlspecialchars($highlight['tag']) ?>
        </span>
        <h2><?= $title ?></h2>
        <p><?= $desc ?></p>
        <div class="service-detail-features">
          <?php foreach ($highlight['features'] as $feat): ?>
            <div class="service-detail-feature">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg>
              <span><?= htmlspecialchars($feat) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
        <a href="contact.php" class="btn btn-pill-primary"><?= $highlight['cta'] ?></a>
      </div>

      <div class="service-detail-visual">
        <?php if ($image): ?>
          <div class="service-image-card">
            <img src="<?= $image ?>" alt="<?= $title ?>" class="service-detail-img" loading="lazy">
            <div class="service-image-badge">
              <span class="service-badge-icon"><?= renderServiceIcon($icon) ?></span>
              <span><?= $title ?></span>
            </div>
          </div>
        <?php else: ?>
          <div>
            <div class="service-visual-icon">
              <?= renderServiceIcon($icon) ?>
            </div>
            <div class="service-visual-title"><?= $title ?></div>
            <div class="service-visual-sub"><?= $highlight['tech'] ?></div>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <?php endforeach; ?>

  </div>
</section>

<!-- Delivery Process Section -->
<section style="background:var(--bg-50);padding:84px 0;border-top:1px solid var(--bg-700);border-bottom:1px solid var(--bg-700);">
  <div class="container">
    <div class="text-center" style="max-width:680px;margin:0 auto 52px;">
      <span class="section-label">Proven Methodology</span>
      <h2 class="section-title">Our 4-Step Engineering Process</h2>
      <p class="section-sub">A disciplined, transparent execution cycle designed to eliminate surprises and guarantee on-time delivery.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:24px;">
      <div style="background:#fff;border:1px solid var(--bg-700);border-radius:18px;padding:32px 24px;box-shadow:var(--shadow-sm);position:relative;">
        <div style="font-family:'Outfit',sans-serif;font-size:2rem;font-weight:900;color:var(--primary);margin-bottom:12px;opacity:0.8;">01</div>
        <h3 style="font-size:1.15rem;font-weight:700;margin-bottom:8px;">Discovery &amp; Scoping</h3>
        <p style="color:var(--text-secondary);font-size:0.88rem;line-height:1.65;margin:0;">
          Deep dive into your business model, target audience, technical requirements, and core success KPIs to formulate an accurate scope of work.
        </p>
      </div>

      <div style="background:#fff;border:1px solid var(--bg-700);border-radius:18px;padding:32px 24px;box-shadow:var(--shadow-sm);position:relative;">
        <div style="font-family:'Outfit',sans-serif;font-size:2rem;font-weight:900;color:#06b6d4;margin-bottom:12px;opacity:0.8;">02</div>
        <h3 style="font-size:1.15rem;font-weight:700;margin-bottom:8px;">Architecture &amp; UX</h3>
        <p style="color:var(--text-secondary);font-size:0.88rem;line-height:1.65;margin:0;">
          Interactive wireframes, Figma prototypes, database schema modeling, and API contract design mapped out before coding begins.
        </p>
      </div>

      <div style="background:#fff;border:1px solid var(--bg-700);border-radius:18px;padding:32px 24px;box-shadow:var(--shadow-sm);position:relative;">
        <div style="font-family:'Outfit',sans-serif;font-size:2rem;font-weight:900;color:#8b5cf6;margin-bottom:12px;opacity:0.8;">03</div>
        <h3 style="font-size:1.15rem;font-weight:700;margin-bottom:8px;">Agile Sprint Coding</h3>
        <p style="color:var(--text-secondary);font-size:0.88rem;line-height:1.65;margin:0;">
          Iterative development sprints with bi-weekly staging reviews. Clean code, version-controlled git branching, and automated linting.
        </p>
      </div>

      <div style="background:#fff;border:1px solid var(--bg-700);border-radius:18px;padding:32px 24px;box-shadow:var(--shadow-sm);position:relative;">
        <div style="font-family:'Outfit',sans-serif;font-size:2rem;font-weight:900;color:#10b981;margin-bottom:12px;opacity:0.8;">04</div>
        <h3 style="font-size:1.15rem;font-weight:700;margin-bottom:8px;">QA, Launch &amp; Scale</h3>
        <p style="color:var(--text-secondary);font-size:0.88rem;line-height:1.65;margin:0;">
          Cross-browser testing, SEO checklist verification, performance audit, SSL launch, and post-launch maintenance handover.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Call to Action Banner -->
<section class="services-cta-section" style="background:#AAC0E1;padding:48px 0;color:#0E2F76;text-align:center;border-top:1.5px solid rgba(14,47,118,0.15);">
  <div class="container" style="max-width:700px;">
    <span class="hero-badge" style="background:rgba(14,47,118,0.12);color:#0E2F76;border:1px solid rgba(14,47,118,0.25);display:inline-flex;margin-bottom:16px;">
      <span class="dot" style="background:#0E2F76;"></span>
      Tailored Solutions
    </span>
    <h2 style="font-family:var(--font-display);font-size:clamp(1.9rem,4vw,2.8rem);font-weight:800;margin-bottom:14px;color:#0E2F76;">
      Need a customized digital package?
    </h2>
    <p style="color:#173874;font-size:1.05rem;line-height:1.75;margin-bottom:28px;">
      Whether you need an MVP built in 3 weeks or an enterprise overhaul with dedicated SEO management, our engineering team is ready to deliver.
    </p>
    <a href="contact.php" class="btn btn-pill-primary" style="padding:14px 34px;font-size:1rem;display:inline-flex;background:#0E2F76 !important;color:#F5FEFF !important;border:1.5px solid #0E2F76 !important;">
      Schedule a Strategy Consultation
    </a>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

</body>
</html>

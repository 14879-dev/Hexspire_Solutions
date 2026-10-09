<?php
/**
 * Hexspire Solutions — Client & Operations Dashboard
 */
session_start();
if (!empty($_SESSION['admin_logged_in'])) {
    header('Location: admin/dashboard.php');
    exit;
}

require_once __DIR__ . '/api/track_visitor.php';
require_once __DIR__ . '/includes/db.php';
$db = getDB();
$logoPath = $db->query("SELECT value FROM hs_settings WHERE `key`='logo_path'")->fetchColumn() ?: '';
$currentPage = 'dashboard';

// Fetch public stats
$projectCount = (int)$db->query("SELECT COUNT(*) FROM hs_projects")->fetchColumn();
$serviceCount = (int)$db->query("SELECT COUNT(*) FROM hs_services")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Client Portal &amp; System Dashboard — Hexspire Solutions</title>
  <meta name="description" content="View real-time service health, project execution metrics, and access the Hexspire Solutions client portal.">
  <link rel="canonical" href="https://hexspiresolutions.com/dashboard.php">
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
<section class="inner-hero">
  <img src="assets/images/hero.webp" alt="" class="inner-hero-bg-img" aria-hidden="true">
  <div class="inner-hero-overlay"></div>
  <div class="container">
    <span class="inner-hero-label">Client Portal &middot; Operations Dashboard</span>
    <h1>Live System &amp; Project Dashboard</h1>
    <p>Real-time infrastructure uptime, ongoing development velocity, and portal authentication.</p>
  </div>
</section>

<!-- Dashboard Content -->
<section class="section" aria-label="Portal Dashboard">
  <div class="container">

    <!-- System Status Grid -->
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px;margin-bottom:48px;">
      
      <div style="background:#fff;border:1px solid var(--bg-700);border-radius:18px;padding:28px;box-shadow:var(--shadow-sm);">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
          <span style="font-size:0.8rem;font-weight:700;text-transform:uppercase;color:var(--text-secondary);letter-spacing:0.05em;">Infrastructure</span>
          <span style="display:inline-flex;align-items:center;gap:6px;background:rgba(16,185,129,0.12);color:#10b981;font-size:0.78rem;font-weight:700;padding:4px 10px;border-radius:99px;">
            <span style="width:7px;height:7px;border-radius:50%;background:#10b981;"></span> Operational
          </span>
        </div>
        <div style="font-family:'Outfit',sans-serif;font-size:2rem;font-weight:800;color:var(--text-primary);">99.98%</div>
        <p style="margin:6px 0 0;font-size:0.85rem;color:var(--text-secondary);">Production Server &amp; Cloud Network Uptime</p>
      </div>

      <div style="background:#fff;border:1px solid var(--bg-700);border-radius:18px;padding:28px;box-shadow:var(--shadow-sm);">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
          <span style="font-size:0.8rem;font-weight:700;text-transform:uppercase;color:var(--text-secondary);letter-spacing:0.05em;">Portfolio Delivery</span>
          <span style="display:inline-flex;align-items:center;gap:6px;background:rgba(13,110,253,0.12);color:var(--primary);font-size:0.78rem;font-weight:700;padding:4px 10px;border-radius:99px;">
            Verified Active
          </span>
        </div>
        <div style="font-family:'Outfit',sans-serif;font-size:2rem;font-weight:800;color:var(--primary);"><?= $projectCount ?>+ Projects</div>
        <p style="margin:6px 0 0;font-size:0.85rem;color:var(--text-secondary);">Delivered Across Web, SEO &amp; Mobile Stacks</p>
      </div>

      <div style="background:#fff;border:1px solid var(--bg-700);border-radius:18px;padding:28px;box-shadow:var(--shadow-sm);">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
          <span style="font-size:0.8rem;font-weight:700;text-transform:uppercase;color:var(--text-secondary);letter-spacing:0.05em;">Client Support SLA</span>
          <span style="display:inline-flex;align-items:center;gap:6px;background:rgba(245,158,11,0.12);color:#f59e0b;font-size:0.78rem;font-weight:700;padding:4px 10px;border-radius:99px;">
            &lt; 2h Response
          </span>
        </div>
        <div style="font-family:'Outfit',sans-serif;font-size:2rem;font-weight:800;color:var(--text-primary);">24/7 Desk</div>
        <p style="margin:6px 0 0;font-size:0.85rem;color:var(--text-secondary);">Direct WhatsApp, Email &amp; Phone Assistance</p>
      </div>

    </div>

    <!-- Client Quick Portal Actions -->
    <div style="display:grid;grid-template-columns:1.2fr 0.8fr;gap:32px;align-items:start;">
      
      <div style="background:#fff;border:1px solid var(--bg-700);border-radius:20px;padding:36px;box-shadow:var(--shadow-sm);">
        <h2 style="font-size:1.4rem;font-weight:800;margin-bottom:10px;">Client Project Milestones</h2>
        <p style="color:var(--text-secondary);font-size:0.92rem;line-height:1.7;margin-bottom:28px;">
          Active clients can submit change requests, review sprint status, or book architecture sessions directly with our engineering team.
        </p>

        <div style="display:flex;flex-direction:column;gap:14px;margin-bottom:28px;">
          <div style="display:flex;align-items:center;gap:14px;padding:14px 18px;background:var(--bg-50);border-radius:12px;border:1px solid var(--bg-700);">
            <div style="width:36px;height:36px;border-radius:8px;background:var(--primary-glow-sm);display:flex;align-items:center;justify-content:center;color:var(--primary);flex-shrink:0;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div>
              <div style="font-weight:700;font-size:0.92rem;">Sprint Verification &amp; Testing</div>
              <div style="font-size:0.8rem;color:var(--text-secondary);">Continuous automated builds and performance profiling</div>
            </div>
          </div>

          <div style="display:flex;align-items:center;gap:14px;padding:14px 18px;background:var(--bg-50);border-radius:12px;border:1px solid var(--bg-700);">
            <div style="width:36px;height:36px;border-radius:8px;background:rgba(16,185,129,0.12);display:flex;align-items:center;justify-content:center;color:#10b981;flex-shrink:0;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <div>
              <div style="font-weight:700;font-size:0.92rem;">SEO Indexation &amp; Rankings Monitor</div>
              <div style="font-size:0.8rem;color:var(--text-secondary);">Weekly search console audit &amp; keyword trajectory analysis</div>
            </div>
          </div>
        </div>

        <a href="index.php#contact" class="btn btn-primary">Submit a Project Request &rarr;</a>
      </div>

      <!-- Admin Access Box -->
      <div style="background:linear-gradient(135deg,#0f172a 0%,#1e293b 100%);color:#fff;border-radius:20px;padding:36px;text-align:center;">
        <div style="width:60px;height:60px;border-radius:16px;background:rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 18px;border:1px solid rgba(255,255,255,0.15);">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="28" height="28"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </div>
        <h3 style="color:#fff;font-size:1.25rem;font-weight:800;margin-bottom:8px;">Administrative Portal</h3>
        <p style="color:rgba(255,255,255,0.7);font-size:0.88rem;line-height:1.65;margin-bottom:24px;">
          Hexspire management and engineering staff can access the internal control center below.
        </p>
        <a href="admin/login.php" class="btn btn-primary" style="display:block;width:100%;text-align:center;padding:12px;">
          Log In to Admin Panel &rarr;
        </a>
      </div>

    </div>

  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

</body>
</html>

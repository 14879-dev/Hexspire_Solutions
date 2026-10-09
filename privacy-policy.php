<?php
/**
 * Hexspire Solutions — Detailed Privacy Policy Page
 */
require_once __DIR__ . '/api/track_visitor.php';
require_once __DIR__ . '/includes/db.php';
$db = getDB();
$logoPath = $db->query("SELECT value FROM hs_settings WHERE `key`='logo_path'")->fetchColumn() ?: '';
$currentPage = '';
$customPrivacyContent = '';
try {
    $customPrivacyContent = $db->query("SELECT content FROM hs_pages WHERE slug='privacy-policy'")->fetchColumn() ?: '';
} catch (\Exception $e) {}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Privacy Policy — Hexspire Solutions</title>
  <meta name="description" content="Read the comprehensive Privacy Policy for Hexspire Solutions. Learn how we collect, handle, protect, and process your data with complete transparency.">
  <link rel="canonical" href="https://hexspiresolutions.com/privacy-policy.php">
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
  <img src="assets/images/hero.webp" alt="Hexspire Privacy Policy Banner" class="inner-hero-bg-img" aria-hidden="true">
  <div class="inner-hero-overlay"></div>
  <div class="container">
    <span class="inner-hero-label">Legal &middot; Hexspire Solutions</span>
    <h1>Privacy Policy</h1>
    <p>Your privacy and data security are fundamental to how we build software. This policy outlines our standards and your rights.</p>
  </div>
</div>

<!-- Content Section -->
<div class="container">
  <div class="privacy-content">
    
    <div class="privacy-last-updated">
      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      Last Updated: <?= date('F j, Y') ?>
    </div>

    <?php if (!empty($customPrivacyContent)): ?>
      <div class="privacy-admin-content">
        <?= $customPrivacyContent ?>
      </div>
    <?php else: ?>
    <h2>1. Introduction &amp; Commitment</h2>
    <p>
      At <strong>Hexspire Solutions</strong> (&ldquo;we&rdquo;, &ldquo;our&rdquo;, or &ldquo;us&rdquo;), registered and operating in Peshawar, Khyber Pakhtunkhwa, Pakistan, we respect your fundamental right to privacy. We are committed to maintaining the highest ethical and technical standards when collecting, processing, and safeguarding your personal information.
    </p>
    <p>
      This Privacy Policy applies to our website (<a href="https://hexspiresolutions.com">hexspiresolutions.com</a>), our client communication channels, customer support, and any related web services operated by Hexspire Solutions. By accessing our website or submitting information through our portal, you acknowledge and agree to the practices described herein.
    </p>

    <h2>2. Information We Collect</h2>
    <p>
      We collect information in two principal ways: information you explicitly provide to us, and technical data automatically captured during your visits.
    </p>
    
    <h3>A. Information You Voluntarily Provide</h3>
    <ul>
      <li><strong>Contact &amp; Identification Data:</strong> When you submit an inquiry through our contact form or request a proposal, we collect your full name, email address, phone number, and subject matter.</li>
      <li><strong>Project &amp; Business Details:</strong> Any architectural details, budget estimates, timeline constraints, or technical documentation you provide regarding your software or SEO requirements.</li>
      <li><strong>Client Account Data:</strong> If you engage our engineering services, we record administrative contact records and invoicing billing details necessary for contract fulfillment.</li>
    </ul>

    <h3>B. Information Automatically Collected</h3>
    <ul>
      <li><strong>Visitor Analytics &amp; Server Logs:</strong> To maintain site security and monitor performance, our servers record anonymous or pseudonymous log data, including IP address, browser user-agent, operating system, referrer URL, timestamp, and requested page routes.</li>
      <li><strong>Usage &amp; Interaction Metrics:</strong> We analyze aggregate navigation patterns, scroll depth, and interaction times to optimize our site speed and layout.</li>
    </ul>

    <h2>3. How We Use Your Information</h2>
    <p>
      We only process your information for legitimate commercial and engineering purposes:
    </p>
    <ul>
      <li>To review, respond to, and fulfill your project inquiries, questions, and requests for quotes.</li>
      <li>To architect, develop, test, and maintain digital products and marketing campaigns commissioned by you.</li>
      <li>To maintain server stability, monitor uptime, prevent cyberattacks, block malicious bots, and protect intellectual property.</li>
      <li>To send critical operational notices regarding service updates, contracts, or technical milestones.</li>
      <li>To comply with applicable Pakistani and international legal requirements and tax regulations.</li>
    </ul>

    <h2>4. Cookies &amp; Tracking Technologies</h2>
    <p>
      Our website uses essential session cookies and performance telemetry:
    </p>
    <ul>
      <li><strong>Essential Cookies:</strong> Required for the fundamental operation of the site, CSRF protection on forms, and security authentication.</li>
      <li><strong>Analytical Telemetry:</strong> Anonymized visit counters used solely to determine aggregate visitor count and regional traffic distribution.</li>
    </ul>
    <p>
      You can configure your browser to reject cookies or alert you when cookies are placed. However, disabling all cookies may impair certain interactive features of our web application.
    </p>

    <h2>5. Zero Data Brokering &amp; Third-Party Disclosures</h2>
    <p>
      <strong>We do not sell, rent, trade, or monetize your personal data to third-party data brokers or marketing firms under any circumstances.</strong>
    </p>
    <p>
      We may share information solely with trusted infrastructure service providers bound by strict confidentiality agreements, including:
    </p>
    <ul>
      <li>Secure cloud hosting providers, DNS networks, and content delivery networks (CDNs).</li>
      <li>Direct transactional email relays utilized to send form responses.</li>
      <li>Legal or regulatory authorities, only when explicitly mandated by a binding court order or lawful Pakistani statutory requirement.</li>
    </ul>

    <h2>6. Data Storage &amp; Security Architecture</h2>
    <p>
      We apply defense-in-depth security principles across our infrastructure:
    </p>
    <ul>
      <li><strong>Encryption in Transit:</strong> All web traffic is strictly served over HTTPS with TLS 1.3 256-bit encryption.</li>
      <li><strong>Sanitization &amp; Defense:</strong> Strict parameterized SQL queries and input sanitization to eliminate SQL injection and cross-site scripting (XSS) risks.</li>
      <li><strong>Restricted Access:</strong> Only authenticated personnel with authorized roles possess access to backend administration tools.</li>
      <li><strong>Automated Backups:</strong> Server snapshots and encrypted off-site database backups are maintained to prevent catastrophic data loss.</li>
    </ul>

    <h2>7. Data Retention Policy</h2>
    <p>
      We retain contact inquiries and correspondence records for as long as necessary to fulfill the commercial purpose for which they were gathered, or to maintain legal and accounting compliance. Inquiries that do not materialize into projects are regularly purged from active storage during annual security reviews.
    </p>

    <h2>8. Your Rights &amp; Control Over Your Data</h2>
    <p>
      Regardless of your geographic location, we provide you with complete sovereignty over your information:
    </p>
    <ul>
      <li><strong>Right of Access:</strong> You may request a summary of the personal details we hold associated with your email address.</li>
      <li><strong>Right to Rectification:</strong> You may request the correction of any inaccurate or outdated information.</li>
      <li><strong>Right to Erasure (&ldquo;Right to be Forgotten&rdquo;):</strong> You may request that we permanently delete your contact details and message logs from our databases.</li>
      <li><strong>Right to Restriction:</strong> You may request that we suspend processing your data for specific purposes.</li>
    </ul>
    <p>
      To exercise any of these rights, simply email our privacy team at <a href="mailto:hexspire.official@gmail.com">hexspire.official@gmail.com</a>. We respond to and process all legitimate requests within 5 business days without charge.
    </p>

    <h2>9. External Links &amp; Third-Party Services</h2>
    <p>
      Our website contains links to external profiles (such as our official LinkedIn, Facebook, Instagram, and WhatsApp channels). Once you follow a link to a third-party platform, their individual privacy policies apply. We encourage you to review their terms before disclosing sensitive personal information.
    </p>

    <h2>10. Children's Privacy</h2>
    <p>
      Our services and marketing are targeted exclusively at businesses, entrepreneurs, and adults over the age of 18. We do not knowingly solicit or collect personal information from individuals under the age of 13. If you believe a minor has submitted personal information to us, please notify us immediately for prompt deletion.
    </p>

    <h2>11. Amendments to This Policy</h2>
    <p>
      We may periodically update this Privacy Policy to reflect advancements in our technology, operational adjustments, or statutory revisions. When updates are published, the &ldquo;Last Updated&rdquo; timestamp at the top of this document will be refreshed accordingly. Continued use of our site constitutes acceptance of revised terms.
    </p>

    <h2>12. Contact Information &amp; Data Officer</h2>
    <p>
      If you have questions, comments, or data rights requests concerning this policy, please contact our team:
    </p>
    <div style="background:var(--bg-50);border:1px solid var(--bg-700);border-radius:14px;padding:24px;margin-top:20px;">
      <p style="margin-bottom:8px;"><strong>Hexspire Solutions — Data &amp; Legal Affairs</strong></p>
      <p style="margin-bottom:8px;"><strong>Email:</strong> <a href="mailto:hexspire.official@gmail.com">hexspire.official@gmail.com</a></p>
      <p style="margin-bottom:8px;"><strong>Phone / WhatsApp:</strong> <a href="tel:+923131990804">+92 313 199 0804</a></p>
      <p style="margin-bottom:0;"><strong>Office Location:</strong> Peshawar, Khyber Pakhtunkhwa, Pakistan</p>
    </div>
    <?php endif; ?>

  </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

</body>
</html>

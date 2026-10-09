<?php
/**
 * Hexspire Solutions — Dedicated Contact Us Page
 * Features direct communication channels, interactive inquiry form, and FAQs
 */
require_once __DIR__ . '/api/track_visitor.php';
require_once __DIR__ . '/includes/db.php';
$db = getDB();
$logoPath = $db->query("SELECT value FROM hs_settings WHERE `key`='logo_path'")->fetchColumn() ?: '';
$currentPage = 'contact';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us — Hexspire Solutions | Web Development &amp; SEO Agency</title>
  <meta name="description" content="Get in touch with Hexspire Solutions in Peshawar, Pakistan. Inquire about web development, custom software, SEO audits, or mobile app engineering.">
  <link rel="canonical" href="https://hexspiresolutions.com/contact.php">
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

<!-- Banner (Matching blog.php style) -->
<div class="inner-hero">
  <img src="assets/images/hero.webp" alt="Hexspire Contact Banner" class="inner-hero-bg-img" aria-hidden="true">
  <div class="inner-hero-overlay"></div>
  <div class="container">
    <span class="inner-hero-label">Get In Touch</span>
    <h1>Contact Our Team</h1>
    <p>Ready to build a custom website, dominate search rankings with SEO, scale with digital marketing, or launch a Flutter mobile app? We are here to help.</p>
  </div>
</div>

<!-- Main Contact Section -->
<section class="section" aria-label="Contact Information and Inquiry Form" style="padding:44px 0 20px;">
  <div class="container">
    <div class="contact-grid">

      <!-- Left Column: Direct Contact Info Cards -->
      <div class="contact-info fade-up fade-up-delay-1">
        <span class="hero-eyebrow" style="color:var(--primary);margin-bottom:8px;">Let's Talk</span>
        <h2 style="font-family:'Space Grotesk','Outfit',sans-serif;font-size:2rem;font-weight:800;margin-bottom:14px;color:#0f172a;">
          Start a Conversation
        </h2>
        <p style="color:var(--text-secondary);font-size:0.98rem;line-height:1.75;margin-bottom:28px;">
          Whether you need a full enterprise web application, high-converting WordPress store, technical SEO audit, or 24/7 server maintenance, our engineering team in Peshawar is ready to deliver.
        </p>

        <div class="contact-details">
          <!-- Email Card (Official Red) -->
          <div class="contact-detail-item">
            <div class="contact-detail-icon contact-icon-email">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <div class="contact-detail-text">
              <strong>Official Email</strong>
              <a href="mailto:hexspire.official@gmail.com" style="color:inherit;text-decoration:none;">hexspire.official@gmail.com</a>
            </div>
          </div>

          <!-- Phone / WhatsApp Card (Official Green) -->
          <div class="contact-detail-item">
            <div class="contact-detail-icon contact-icon-phone">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </div>
            <div class="contact-detail-text">
              <strong>Phone &amp; WhatsApp</strong>
              <a href="tel:+923131990804" style="color:inherit;text-decoration:none;">+92 313 199 0804</a>
            </div>
          </div>

          <!-- Office Location Card (Official Navy / Location Pin) -->
          <div class="contact-detail-item">
            <div class="contact-detail-icon contact-icon-location">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div class="contact-detail-text">
              <strong>Office Headquarters</strong>
              <span>Peshawar, Khyber Pakhtunkhwa, Pakistan</span>
            </div>
          </div>

          <!-- Working Hours Card (Official Gold/Amber Clock) -->
          <div class="contact-detail-item">
            <div class="contact-detail-icon contact-icon-hours">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="contact-detail-text">
              <strong>Business Hours</strong>
              <span>Monday – Saturday, 9:00 AM – 6:00 PM PKT</span>
            </div>
          </div>
        </div>

        <!-- Social Media Channels with Brand Colors -->
        <div class="contact-socials" style="margin-top:28px;">
          <a href="https://www.linkedin.com/company/hexspire-solutions/" class="contact-social contact-social-linkedin" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
          </a>
          <a href="https://wa.me/923131990804" class="contact-social contact-social-whatsapp" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          </a>
          <a href="https://www.facebook.com/share/1AHQaEmYoK/" class="contact-social contact-social-facebook" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          </a>
          <a href="https://www.instagram.com/hexspire.solutions?mdxt=MXByMmhwaDdtdzlhbA==" class="contact-social contact-social-instagram" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
          </a>
        </div>
      </div>

      <!-- Right Column: Interactive Proposal & Inquiry Form -->
      <div class="contact-form-wrap fade-up fade-up-delay-2">
        <form id="contact-form" novalidate>
          <div id="form-message" class="form-message" role="alert" style="margin-top:0;margin-bottom:20px;"></div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="cf-name">Your Full Name</label>
              <input type="text" id="cf-name" name="name" placeholder="e.g. Mudassir Munir" required autocomplete="name">
            </div>
            <div class="form-group">
              <label for="cf-email">Email Address</label>
              <input type="email" id="cf-email" name="email" placeholder="you@company.com" required autocomplete="email">
            </div>
          </div>

          <div class="form-group">
            <label for="cf-subject">Subject / Project Type</label>
            <input type="text" id="cf-subject" name="subject" placeholder="e.g. Web App Development / SEO Consultation" required>
          </div>

          <div class="form-group">
            <label for="cf-message">Project Brief &amp; Requirements</label>
            <textarea id="cf-message" name="message" placeholder="Please outline your objectives, required features, timeline, and any specific preferences..." required style="min-height:140px;"></textarea>
          </div>

          <button type="submit" class="btn-pill-primary form-submit" id="contact-submit" style="width:100%;justify-content:center;padding:14px 28px;font-size:1rem;">
            Send Inquiry
          </button>
        </form>
      </div>

    </div>

    <!-- Frequently Asked Questions (Transferred from Home) -->
    <div style="margin-top:44px;padding-top:36px;border-top:1px solid var(--bg-700);">
      <div class="text-center" style="max-width:680px;margin:0 auto 36px;">
        <span class="hero-eyebrow fade-up" style="color:var(--primary);margin-bottom:12px;">Frequently Asked Questions</span>
        <h2 style="font-family:'Space Grotesk','Outfit',sans-serif;font-size:clamp(1.8rem,3.2vw,2.4rem);font-weight:800;color:#0f172a;" class="fade-up fade-up-delay-1">
          Everything You Need to Know
        </h2>
        <p style="color:var(--text-secondary);font-size:1rem;line-height:1.7;" class="fade-up fade-up-delay-2">
          Clear answers regarding our development cycles, pricing, SEO methodologies, and ongoing maintenance.
        </p>
      </div>

      <div class="faq-list" id="faq-list">
        <!-- Dynamically populated from hs_faqs via main.js -->
      </div>
    </div>

  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
</body>
</html>

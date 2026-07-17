<?php
/**
 * Hexspire Solutions — Public Single-Page Marketing Site
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hexspire Solutions — Web Development & SEO | Peshawar, Pakistan</title>
  <meta name="description" content="Hexspire Solutions delivers cutting-edge web development and SEO services from Peshawar, Pakistan. We craft blazing-fast websites and data-driven strategies that grow your business online.">
  <meta name="keywords" content="web development Peshawar, SEO Pakistan, website design, digital marketing, Hexspire Solutions">
  <meta name="author" content="Hexspire Solutions">
  <meta property="og:title" content="Hexspire Solutions — Web Development & SEO">
  <meta property="og:description" content="Cutting-edge web development and SEO from Peshawar, Pakistan.">
  <meta property="og:type" content="website">
  <link rel="canonical" href="https://hexspiresolutions.com/">
  <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">
  <link rel="icon" type="image/svg+xml" href="uploads/logo/default.svg">
</head>
<body>

<!-- ── Animated Background ── -->
<div id="bg-canvas" aria-hidden="true">
  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>
  <div class="blob blob-3"></div>
  <div class="blob blob-4"></div>
</div>

<!-- ── Logo Badge (Top Center) ── -->
<div id="logo-badge" aria-label="Hexspire Solutions">
  <span class="logo-placeholder">Hexspire</span>
</div>

<!-- ── macOS Dock Navigation ── -->
<nav id="dock-nav" role="navigation" aria-label="Main Navigation">
  <!-- Built dynamically by main.js -->
</nav>

<!-- ================================================================
     SECTION 1: HERO
     ================================================================ -->
<section id="hero" aria-label="Hero">
  <!-- Background image layer -->
  <div class="hero-bg" aria-hidden="true">
    <img src="assets/images/hero.png?v=2" alt="" class="hero-bg-image">
    <div class="hero-bg-overlay"></div>
  </div>

  <div class="container">
    <div class="hero-grid">
      <div class="hero-content">
        <div class="hero-badge fade-up">
          <span class="dot"></span>
          Web Dev &amp; SEO · Peshawar, Pakistan
        </div>
        <h1 class="hero-title fade-up fade-up-delay-1">
          Transforming Ideas<br>
          Into Digital <span class="accent">Solutions</span>
        </h1>
        <p class="hero-sub fade-up fade-up-delay-2">
          Hexspire Solutions crafts high-performance websites and data-driven SEO strategies that put your business on the digital map — and keep it there.
        </p>
        <div class="hero-ctas fade-up fade-up-delay-3">
          <a href="#contact" class="btn btn-primary" id="hero-cta-contact">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            Get In Touch
          </a>
          <a href="#projects" class="btn btn-outline" id="hero-cta-projects">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            View Projects
          </a>
        </div>
      </div>
      <!-- hero-image-wrap removed — image now lives in .hero-bg above -->
    </div>
  </div>

  <!-- Scroll indicator -->
  <div class="hero-scroll-indicator" aria-hidden="true">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="6 9 12 15 18 9"/></svg>
    <span>Scroll</span>
  </div>
</section>

<div class="section-divider"></div>

 
<!-- ================================================================
     SECTION 2: ABOUT
     ================================================================ -->
<section id="about" class="section" aria-label="About Us">
  <div class="container">
    <div class="about-grid">

      <!-- Left: Content -->
      <div class="about-content">
        <span class="section-label fade-up">About Us</span>
        <h2 class="section-title fade-up fade-up-delay-1">
         Local Roots,<br>Global Vision<span style="background:linear-gradient(135deg,var(--orange-400),var(--orange-500));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">Vision</span>
        </h2>
        <p class="section-sub fade-up fade-up-delay-2">
          Hexspire Solutions was founded with a clear mission: to give businesses of all sizes access to world-class web development and SEO expertise — delivered by a passionate team right here in Peshawar.
        </p>
        <p class="section-sub fade-up fade-up-delay-3" style="margin-top:12px;">
          Our team of six specialists covers every pillar of digital growth: from pixel-perfect frontend design and robust backend development, to technical SEO and performance optimization. We don't just build websites — we build growth engines.
        </p>

        <div class="about-features fade-up fade-up-delay-4">
          <div class="about-feature">
            <div class="about-feature-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="9 12 11 14 15 10"/><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <div class="about-feature-text">
              <strong>Client-First Approach</strong>
              <span>We listen before we build — every solution is tailored to your unique goals.</span>
            </div>
          </div>
          <div class="about-feature">
            <div class="about-feature-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            </div>
            <div class="about-feature-text">
              <strong>Data-Driven Results</strong>
              <span>Every decision is backed by analytics, testing, and real performance metrics.</span>
            </div>
          </div>
          <div class="about-feature">
            <div class="about-feature-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="about-feature-text">
              <strong>On-Time Delivery</strong>
              <span>We respect your schedule and maintain transparent communication throughout.</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Right: Stats -->
      <div class="about-stats fade-up fade-up-delay-2">
        <!-- Circular badge -->
        <div class="stats-badge">
          <div class="stats-badge-ring">
            <div class="stats-badge-inner">
              <span class="stats-badge-number">2+</span>
              <span class="stats-badge-label">Years of<br>Excellence</span>
            </div>
          </div>
        </div>

        <!-- Stat counters -->
        <div class="stats-counters">
          <div class="stat-counter">
            <div class="stat-counter-value" data-count="10" data-suffix="+">0+</div>
            <div class="stat-counter-label">Projects Delivered</div>
          </div>
          <div class="stat-counter">
            <div class="stat-counter-value" data-count="5" data-suffix="+">0+</div>
            <div class="stat-counter-label">Happy Clients</div>
          </div>
          <div class="stat-counter">
            <div class="stat-counter-value" data-count="6">0</div>
            <div class="stat-counter-label">Team Members</div>
          </div>
          <div class="stat-counter">
            <div class="stat-counter-value" data-count="95" data-suffix="+">0%</div>
            <div class="stat-counter-label">Satisfaction Rate</div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<div class="section-divider"></div>

<!-- ================================================================
     SECTION 3: SERVICES
     ================================================================ -->
<section id="services" class="section" aria-label="Our Services">
  <div class="container">
    <div class="text-center">
      <span class="section-label fade-up">What We Do</span>
      <h2 class="section-title fade-up fade-up-delay-1">Our Core Services</h2>
      <p class="section-sub fade-up fade-up-delay-2">
        From concept to launch and beyond — we provide end-to-end digital solutions that drive real business results.
      </p>
    </div>
    <div class="services-grid" id="services-grid">
      <!-- Loading skeletons -->
      <?php for ($i = 0; $i < 6; $i++): ?>
      <div class="service-card" style="pointer-events:none">
        <div class="service-icon" style="background:rgba(255,255,255,0.04)"></div>
        <div class="skeleton" style="height:18px;width:60%;margin-bottom:12px"></div>
        <div class="skeleton" style="height:12px;width:100%;margin-bottom:6px"></div>
        <div class="skeleton" style="height:12px;width:85%;margin-bottom:6px"></div>
        <div class="skeleton" style="height:12px;width:70%;margin-bottom:18px"></div>
        <div class="skeleton" style="height:12px;width:100px"></div>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>

<div class="section-divider"></div>

<!-- ================================================================
     SECTION 4: PROJECTS
     ================================================================ -->
<section id="projects" class="section" aria-label="Our Projects">
  <div class="container">
    <div class="text-center">
      <span class="section-label fade-up">Our Work</span>
      <h2 class="section-title fade-up fade-up-delay-1">Featured Projects</h2>
      <p class="section-sub fade-up fade-up-delay-2">
        A selection of the web experiences, SEO campaigns, and digital solutions we've built for our clients.
      </p>
    </div>
    <div class="projects-filter fade-up fade-up-delay-3" id="projects-filter">
      <!-- Built dynamically -->
    </div>
    <div class="projects-grid" id="projects-grid">
      <!-- Built dynamically -->
    </div>
  </div>
</section>

<div class="section-divider"></div>

<!-- ================================================================
     SECTION 5: TEAM
     ================================================================ -->
<section id="team" class="section" aria-label="Our Team">
  <div class="container">
    <div class="text-center">
      <span class="section-label fade-up">The People</span>
      <h2 class="section-title fade-up fade-up-delay-1">Meet Our Team</h2>
      <p class="section-sub fade-up fade-up-delay-2">
        Six specialists, one shared goal — delivering digital solutions that exceed expectations.
      </p>
    </div>
    <div class="team-grid" id="team-grid">
      <!-- Built dynamically -->
    </div>
  </div>
</section>

<div class="section-divider"></div>

<!-- ================================================================
     SECTION 6: CONTACT & FAQs
     ================================================================ -->
<section id="contact" class="section" aria-label="Contact Us">
  <div class="container">
    <div class="text-center">
      <span class="section-label fade-up">Let's Talk</span>
      <h2 class="section-title fade-up fade-up-delay-1">Get In Touch</h2>
      <p class="section-sub fade-up fade-up-delay-2">
        Have a project in mind or want to learn how we can help? Send us a message and we'll get back to you within 24 hours.
      </p>
    </div>

    <div class="contact-grid">


      <!-- Contact Info -->
      <div class="contact-info fade-up fade-up-delay-2">
        <h3>Let's Start a Conversation</h3>
        <p>We're always happy to discuss new opportunities, answer questions, or just say hello. Reach out through the form or contact us directly.</p>

        <div class="contact-details">
          <div class="contact-detail-item">
            <div class="contact-detail-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="18" height="18"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <div class="contact-detail-text">
              <strong>Email</strong>
              <span>hexspire.offical@gmail.com</span>
            </div>
          </div>
          <div class="contact-detail-item">
            <div class="contact-detail-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="18" height="18"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </div>
            <div class="contact-detail-text">
              <strong>Phone</strong>
              <span>+92 3131990804</span>
            </div>
          </div>
          <div class="contact-detail-item">
            <div class="contact-detail-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="18" height="18"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div class="contact-detail-text">
              <strong>Location</strong>
              <span>Peshawar, Khyber Pakhtunkhwa, Pakistan</span>
            </div>
          </div>
        </div>

        <!-- Social Links -->
        <div class="contact-socials" style="margin-top:28px;">
          <a href="#" class="contact-social" aria-label="Facebook">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          </a>
          <a href="#" class="contact-social" aria-label="Instagram">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
          </a>
          <a href="#" class="contact-social" aria-label="LinkedIn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
          </a>
          <a href="#" class="contact-social" aria-label="Twitter / X">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.7 5.5 4.4 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
          </a>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="contact-form-wrap fade-up fade-up-delay-3">
        <form id="contact-form" novalidate>
          <div id="form-message" class="form-message" role="alert" style="margin-top:0;margin-bottom:20px;"></div>
          <div class="form-row">
            <div class="form-group">
              <label for="cf-name">Your Name</label>
              <input type="text" id="cf-name" name="name" placeholder="e.g. Ali Hassan" required autocomplete="name">
            </div>
            <div class="form-group">
              <label for="cf-email">Email Address</label>
              <input type="email" id="cf-email" name="email" placeholder="you@example.com" required autocomplete="email">
            </div>
          </div>
          <div class="form-group">
            <label for="cf-subject">Subject</label>
            <input type="text" id="cf-subject" name="subject" placeholder="What's this about?" required>
          </div>
          <div class="form-group">
            <label for="cf-message">Message</label>
            <textarea id="cf-message" name="message" placeholder="Tell us about your project or inquiry…" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary form-submit" id="contact-submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            Send Message
          </button>
        </form>
      </div>

      </div>

      <div style="margin-top: 80px; padding-top: 60px; border-top: 1px solid var(--bg-700)">
        <div class="text-center">
          <span class="section-label fade-up">Got Questions?</span>
          <h2 class="section-title fade-up fade-up-delay-1">Frequently Asked Questions</h2>
          <p class="section-sub fade-up fade-up-delay-2">
            Here are some of the most common questions we get. Didn't find your answer? Reach out!
          </p>
        </div>
        <div class="faq-list" id="faq-list">
          <!-- Built dynamically -->
        </div>
      </div>
      
    </div>
  </div>
</section>

<footer>
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

<script src="assets/js/main.js?v=<?= time() ?>"></script>
</body>
</html>

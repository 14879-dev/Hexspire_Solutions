<?php
require_once __DIR__ . '/includes/db.php';
$db = getDB();

$aboutUsContent = '
<h2>Who We Are</h2>
<p>Hexspire Solutions is a premier digital agency rooted in Peshawar, Pakistan, dedicated to transforming ideas into powerful digital realities. We specialize in cutting-edge web development, data-driven SEO, and comprehensive digital marketing strategies.</p>
<h2>Our Mission</h2>
<p>Our team of experts combines technical excellence with creative innovation to build solutions that not only look stunning but drive tangible business growth. From bespoke websites to high-converting marketing campaigns, we are your trusted partners in navigating the digital landscape.</p>
<h2>Why Choose Us</h2>
<p>Our mission is to empower brands to exceed their potential, delivering digital experiences that matter. We don\'t just write code; we craft digital success stories.</p>
';

$privacyPolicyContent = '
<h2>Privacy Policy</h2>
<p>At Hexspire Solutions, we prioritize the privacy and security of our clients and website visitors. This policy explains how we collect, use, and protect your information.</p>

<h3>1. Information Collection</h3>
<p>We collect information you provide directly through our contact forms, such as your name, email address, and project details. We also use cookies to improve user experience.</p>

<h3>2. Use of Information</h3>
<p>Your data is used exclusively to respond to your inquiries, deliver our digital services, and optimize our website\'s performance.</p>

<h3>3. Data Protection</h3>
<p>We implement industry-standard security measures to safeguard your personal data against unauthorized access or disclosure.</p>

<h3>4. Third-Party Sharing</h3>
<p>We do not sell, trade, or rent your personal information to third parties. We only share information with trusted partners who assist us in operating our website, provided they agree to keep it confidential.</p>

<h3>5. Your Rights</h3>
<p>You have the right to request access to or deletion of your personal data at any time by contacting us at hello@hexspiresolutions.com.</p>
';

// Check if they exist, update or insert
$stmt = $db->prepare("SELECT id FROM hs_pages WHERE slug = ?");

// About Us
$stmt->execute(['about-us']);
if ($stmt->fetch()) {
    $db->prepare("UPDATE hs_pages SET content = ? WHERE slug = 'about-us'")->execute([$aboutUsContent]);
} else {
    $db->prepare("INSERT INTO hs_pages (title, slug, content) VALUES ('About Us', 'about-us', ?)")->execute([$aboutUsContent]);
}

// Privacy Policy
$stmt->execute(['privacy-policy']);
if ($stmt->fetch()) {
    $db->prepare("UPDATE hs_pages SET content = ? WHERE slug = 'privacy-policy'")->execute([$privacyPolicyContent]);
} else {
    $db->prepare("INSERT INTO hs_pages (title, slug, content) VALUES ('Privacy Policy', 'privacy-policy', ?)")->execute([$privacyPolicyContent]);
}

echo "<div style='font-family:sans-serif; text-align:center; padding: 50px; color: #333;'>";
echo "<h1>✅ Success!</h1>";
echo "<p>About Us and Privacy Policy pages have been successfully populated with professional data in your database.</p>";
echo "<a href='pages.php' style='display:inline-block; margin-top:20px; padding: 10px 20px; background: #0d6efd; color: white; text-decoration: none; border-radius: 8px;'>Back to Pages Admin</a>";
echo "<br><br><a href='../index.php' style='color:#0d6efd;'>Or go to Public Site</a>";
echo "</div>";
?>

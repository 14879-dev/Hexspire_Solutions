<?php
/**
 * Hexspire Solutions — One-Time Database Setup
 * Visit once to create tables and seed default data.
 * DELETE or password-protect this file after running!
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'hexspire_solutions');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    // Create database if not exists
    $pdo = new PDO("mysql:host=" . DB_HOST . ";charset=utf8mb4", DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `" . DB_NAME . "`");

    // Settings table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `hs_settings` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `key` VARCHAR(100) NOT NULL UNIQUE,
        `value` TEXT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // Services table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `hs_services` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `icon` VARCHAR(100) NOT NULL DEFAULT 'code',
        `title` VARCHAR(200) NOT NULL,
        `description` TEXT,
        `sort_order` INT DEFAULT 0,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // Projects table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `hs_projects` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(200) NOT NULL,
        `category` VARCHAR(100) DEFAULT 'Web',
        `description` TEXT,
        `image_path` VARCHAR(300),
        `link` VARCHAR(500),
        `sort_order` INT DEFAULT 0,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // Team table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `hs_team` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(200) NOT NULL,
        `role` VARCHAR(200),
        `photo_path` VARCHAR(300),
        `linkedin` VARCHAR(500),
        `twitter` VARCHAR(500),
        `github` VARCHAR(500),
        `sort_order` INT DEFAULT 0,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // Messages table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `hs_messages` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(200) NOT NULL,
        `email` VARCHAR(300) NOT NULL,
        `subject` VARCHAR(300),
        `message` TEXT,
        `is_read` TINYINT(1) DEFAULT 0,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // --- Seed default data ---

    // Admin credentials
    $adminUser = 'admin';
    $adminPass = password_hash('hexspire2024', PASSWORD_BCRYPT);
    $pdo->exec("INSERT IGNORE INTO `hs_settings` (`key`, `value`) VALUES
        ('admin_username', '$adminUser'),
        ('admin_password_hash', '$adminPass'),
        ('logo_path', '')
    ");

    // Default services
    $existingServices = $pdo->query("SELECT COUNT(*) FROM hs_services")->fetchColumn();
    if ($existingServices == 0) {
        $pdo->exec("INSERT INTO `hs_services` (icon, title, description, sort_order) VALUES
            ('globe', 'Web Development', 'We craft blazing-fast, responsive websites and web applications tailored to your business goals — from landing pages to full-scale platforms.', 1),
            ('search', 'SEO Optimization', 'Dominate search rankings with our data-driven SEO strategies — technical audits, keyword research, on-page optimization, and link building.', 2),
            ('smartphone', 'Mobile-Friendly Design', 'Every site we build is pixel-perfect across all devices, ensuring your visitors get a seamless experience whether on phone, tablet, or desktop.', 3),
            ('bar-chart-2', 'Digital Marketing', 'Grow your brand with targeted digital marketing campaigns — social media, PPC, content strategy, and conversion-rate optimization.', 4),
            ('shield-check', 'Website Maintenance', 'Keep your site secure, updated, and performing at peak — we offer ongoing maintenance plans so you can focus on your business.', 5),
            ('zap', 'Performance Optimization', 'We analyze and eliminate bottlenecks, reducing load times and improving Core Web Vitals scores for better rankings and user retention.', 6)
        ");
    }

    // Default projects
    $existingProjects = $pdo->query("SELECT COUNT(*) FROM hs_projects")->fetchColumn();
    if ($existingProjects == 0) {
        $pdo->exec("INSERT INTO `hs_projects` (title, category, description, image_path, link, sort_order) VALUES
            ('Al-Noor E-Commerce', 'Web', 'Full-stack e-commerce platform with custom CMS, payment integration, and mobile-first design.', '', '#', 1),
            ('PeshawarEats Food App', 'App', 'Restaurant discovery and delivery tracking app UI built for a local food aggregator startup.', '', '#', 2),
            ('TechPK Blog SEO Overhaul', 'SEO', 'Complete technical SEO audit and restructure that tripled organic traffic within 4 months.', '', '#', 3),
            ('QuickLawyerPK Portal', 'Web', 'Legal services booking portal with client dashboard, document upload, and appointment scheduling.', '', '#', 4),
            ('KP Tourism Authority', 'Web', 'Tourism promotion website with interactive map, photo gallery, and multilingual support.', '', '#', 5),
            ('StartupPK Directory', 'SEO', 'SEO-focused directory site with schema markup, optimized content clusters, and backlink strategy.', '', '#', 6)
        ");
    }

    // Default team members
    $existingTeam = $pdo->query("SELECT COUNT(*) FROM hs_team")->fetchColumn();
    if ($existingTeam == 0) {
        $pdo->exec("INSERT INTO `hs_team` (name, role, photo_path, linkedin, twitter, github, sort_order) VALUES
            ('Ali Hassan', 'Founder & Lead Developer', '', 'https://linkedin.com', '', 'https://github.com', 1),
            ('Sana Mehmood', 'SEO Strategist', '', 'https://linkedin.com', 'https://twitter.com', '', 2),
            ('Umar Farooq', 'Frontend Developer', '', '', '', 'https://github.com', 3),
            ('Zara Khan', 'UI/UX Designer', '', 'https://linkedin.com', 'https://twitter.com', '', 4),
            ('Bilal Afridi', 'Backend Developer', '', '', '', 'https://github.com', 5),
            ('Nadia Yousaf', 'Digital Marketing Manager', '', 'https://linkedin.com', 'https://twitter.com', '', 6)
        ");
    }

    echo '<div style="font-family:sans-serif;max-width:600px;margin:60px auto;padding:40px;background:#f0fdf4;border:2px solid #22c55e;border-radius:12px;">';
    echo '<h2 style="color:#16a34a;">✅ Database Setup Complete!</h2>';
    echo '<p>All tables created and seed data inserted successfully.</p>';
    echo '<p><strong>Default Admin Login:</strong></p>';
    echo '<ul><li>Username: <code>admin</code></li><li>Password: <code>hexspire2024</code></li></ul>';
    echo '<p style="color:#dc2626;font-weight:bold;">⚠️ Important: Delete or rename this file (setup.php) immediately for security!</p>';
    echo '<p><a href="/" style="color:#2563eb;">→ Go to Public Site</a> | <a href="/admin/" style="color:#2563eb;">→ Go to Admin Panel</a></p>';
    echo '</div>';

} catch (PDOException $e) {
    echo '<div style="font-family:sans-serif;max-width:600px;margin:60px auto;padding:40px;background:#fef2f2;border:2px solid #ef4444;border-radius:12px;">';
    echo '<h2 style="color:#dc2626;">❌ Setup Failed</h2>';
    echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<p>Check your database credentials in <code>includes/db.php</code> and ensure MySQL is running.</p>';
    echo '</div>';
}

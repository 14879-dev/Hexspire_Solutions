<?php
$dbFile = __DIR__ . '/local_dev.sqlite';
$sqlite = new PDO('sqlite:' . $dbFile);
$sqlite->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sqlite->exec("CREATE TABLE IF NOT EXISTS hs_settings (id INTEGER PRIMARY KEY, [key] TEXT UNIQUE, value TEXT);");
$sqlite->exec("CREATE TABLE IF NOT EXISTS hs_services (id INTEGER PRIMARY KEY, title TEXT, description TEXT, icon TEXT, sort_order INTEGER);");
$sqlite->exec("CREATE TABLE IF NOT EXISTS hs_projects (id INTEGER PRIMARY KEY, title TEXT, category TEXT, image_path TEXT, description TEXT, link TEXT, sort_order INTEGER);");
$sqlite->exec("CREATE TABLE IF NOT EXISTS hs_team (id INTEGER PRIMARY KEY, name TEXT, role TEXT, bio TEXT, image_path TEXT, sort_order INTEGER);");
$sqlite->exec("CREATE TABLE IF NOT EXISTS hs_blog_posts (id INTEGER PRIMARY KEY, title TEXT, slug TEXT UNIQUE, content TEXT, image_path TEXT, author TEXT, is_published INTEGER, created_at TEXT);");
$sqlite->exec("CREATE TABLE IF NOT EXISTS hs_messages (id INTEGER PRIMARY KEY, name TEXT, email TEXT, subject TEXT, message TEXT, is_read INTEGER, created_at TEXT);");
$sqlite->exec("CREATE TABLE IF NOT EXISTS hs_faqs (id INTEGER PRIMARY KEY, question TEXT, answer TEXT, sort_order INTEGER);");
$sqlite->exec("CREATE TABLE IF NOT EXISTS hs_pages (id INTEGER PRIMARY KEY, slug TEXT UNIQUE, title TEXT, content TEXT);");
$sqlite->exec("CREATE TABLE IF NOT EXISTS hs_visitors (id INTEGER PRIMARY KEY, ip_address TEXT, user_agent TEXT, visits INTEGER, last_visit TEXT);");

$sqlite->exec("INSERT OR IGNORE INTO hs_settings ([key], value) VALUES ('logo_path', 'assets/images/favicon.png');");

// Seed sample project if empty
$pCount = $sqlite->query("SELECT COUNT(*) FROM hs_projects")->fetchColumn();
if ($pCount == 0) {
    $sqlite->exec("INSERT INTO hs_projects (title, category, image_path, description, link) VALUES 
    ('Apex Healthcare Portal', 'Web Development', 'assets/images/hero.webp', 'Comprehensive healthcare management system with automated scheduling.', 'https://hexspiresolutions.com'),
    ('Lumina E-Commerce Store', 'E-Commerce', 'assets/images/hero.webp', 'High-conversion online retail store with real-time stock sync.', 'https://hexspiresolutions.com'),
    ('Khyber Logistics Tracker', 'Web Development', 'assets/images/hero.webp', 'Real-time fleet tracking and dispatch optimization platform.', 'https://hexspiresolutions.com');");
}

// Seed sample services if empty
$sCount = $sqlite->query("SELECT COUNT(*) FROM hs_services")->fetchColumn();
if ($sCount == 0) {
    $sqlite->exec("INSERT INTO hs_services (title, description, icon, sort_order) VALUES 
    ('Web Development', 'High-performance bespoke web applications engineered for speed, stability, and scale.', 'code', 1),
    ('SEO Optimization', 'Data-driven technical SEO and content architecture designed to dominate search rankings.', 'search', 2),
    ('Mobile App Engineering', 'Cross-platform native-feel applications built on Flutter and React Native.', 'smartphone', 3);");
}

echo "Database ready.\n";

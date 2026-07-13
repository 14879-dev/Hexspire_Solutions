-- Hexspire Solutions Database Schema
-- Run this in phpMyAdmin or your preferred SQL client

DROP DATABASE IF EXISTS `hexspire_db`;
CREATE DATABASE `hexspire_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `hexspire_db`;

-- Settings table
CREATE TABLE IF NOT EXISTS `hs_settings` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `key` VARCHAR(100) NOT NULL UNIQUE,
    `value` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Services table
CREATE TABLE IF NOT EXISTS `hs_services` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `icon` VARCHAR(100) NOT NULL DEFAULT 'code',
    `title` VARCHAR(200) NOT NULL,
    `description` TEXT,
    `sort_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Projects table
CREATE TABLE IF NOT EXISTS `hs_projects` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(200) NOT NULL,
    `category` VARCHAR(100) DEFAULT 'Web',
    `description` TEXT,
    `image_path` VARCHAR(300),
    `link` VARCHAR(500),
    `sort_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Team table
CREATE TABLE IF NOT EXISTS `hs_team` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(200) NOT NULL,
    `role` VARCHAR(200),
    `photo_path` VARCHAR(300),
    `linkedin` VARCHAR(500),
    `twitter` VARCHAR(500),
    `github` VARCHAR(500),
    `sort_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Messages table
CREATE TABLE IF NOT EXISTS `hs_messages` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(200) NOT NULL,
    `email` VARCHAR(300) NOT NULL,
    `subject` VARCHAR(300),
    `message` TEXT,
    `is_read` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --- Seed default data ---

-- Admin credentials (username: admin, password: hexspire2024)
INSERT IGNORE INTO `hs_settings` (`key`, `value`) VALUES
('admin_username', 'admin'),
('admin_password_hash', '$2y$10$K9A.Yg0182n9yqD0X3hK7eS5hFf4O9V5R6C.2A9d0R4V.lA41pM/W'),
('logo_path', '');

-- Default services
INSERT INTO `hs_services` (icon, title, description, sort_order) VALUES
('globe', 'Web Development', 'We craft blazing-fast, responsive websites and web applications tailored to your business goals — from landing pages to full-scale platforms.', 1),
('search', 'SEO Optimization', 'Dominate search rankings with our data-driven SEO strategies — technical audits, keyword research, on-page optimization, and link building.', 2),
('smartphone', 'Mobile-Friendly Design', 'Every site we build is pixel-perfect across all devices, ensuring your visitors get a seamless experience whether on phone, tablet, or desktop.', 3),
('bar-chart-2', 'Digital Marketing', 'Grow your brand with targeted digital marketing campaigns — social media, PPC, content strategy, and conversion-rate optimization.', 4),
('shield-check', 'Website Maintenance', 'Keep your site secure, updated, and performing at peak — we offer ongoing maintenance plans so you can focus on your business.', 5),
('layout', 'UI/UX Design', 'We create intuitive, engaging, and accessible user interfaces that deliver exceptional digital experiences and drive customer satisfaction.', 6);

-- Default projects
INSERT INTO `hs_projects` (title, category, description, image_path, link, sort_order) VALUES
('Al-Noor E-Commerce', 'Web', 'Full-stack e-commerce platform with custom CMS, payment integration, and mobile-first design.', '', '#', 1),
('PeshawarEats Food App', 'App', 'Restaurant discovery and delivery tracking app UI built for a local food aggregator startup.', '', '#', 2),
('TechPK Blog SEO Overhaul', 'SEO', 'Complete technical SEO audit and restructure that tripled organic traffic within 4 months.', '', '#', 3),
('QuickLawyerPK Portal', 'Web', 'Legal services booking portal with client dashboard, document upload, and appointment scheduling.', '', '#', 4),
('KP Tourism Authority', 'Web', 'Tourism promotion website with interactive map, photo gallery, and multilingual support.', '', '#', 5),
('StartupPK Directory', 'SEO', 'SEO-focused directory site with schema markup, optimized content clusters, and backlink strategy.', '', '#', 6);

-- Default team members
INSERT INTO `hs_team` (name, role, photo_path, linkedin, twitter, github, sort_order) VALUES
('Ali Hassan', 'Founder & Lead Developer', '', 'https://linkedin.com', '', 'https://github.com', 1),
('Sana Mehmood', 'SEO Strategist', '', 'https://linkedin.com', 'https://twitter.com', '', 2),
('Umar Farooq', 'Frontend Developer', '', '', '', 'https://github.com', 3),
('Zara Khan', 'UI/UX Designer', '', 'https://linkedin.com', 'https://twitter.com', '', 4),
('Bilal Afridi', 'Backend Developer', '', '', '', 'https://github.com', 5),
('Nadia Yousaf', 'Digital Marketing Manager', '', 'https://linkedin.com', 'https://twitter.com', '', 6);

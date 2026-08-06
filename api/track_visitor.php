<?php
/**
 * Hexspire Solutions — Unique Visitor Tracker
 * Tracks each unique IP address once. Same IP = counted once only.
 */
require_once __DIR__ . '/../includes/db.php';

$db   = getDB();
$ip   = $_SERVER['HTTP_CF_CONNECTING_IP']   // Cloudflare real IP
     ?? $_SERVER['HTTP_X_FORWARDED_FOR']    // Proxy/load-balancer
     ?? $_SERVER['REMOTE_ADDR']             // Direct connection
     ?? 'unknown';

// Only take first IP if there are multiple (comma-separated)
$ip = trim(explode(',', $ip)[0]);

// Silently skip if table doesn't exist yet (safety net)
try {
    $stmt = $db->prepare("
        INSERT INTO hs_visitors (ip_address, visits, last_visit)
        VALUES (?, 1, NOW())
        ON DUPLICATE KEY UPDATE
            visits    = visits + 1,
            last_visit = NOW()
    ");
    $stmt->execute([$ip]);
} catch (\Exception $e) {
    // Fail silently — never break the public site
}

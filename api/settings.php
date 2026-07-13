<?php
require_once __DIR__ . '/../includes/db.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$key = trim($_GET['key'] ?? '');
if (empty($key)) {
    echo json_encode(['value' => null]);
    exit;
}

$db   = getDB();
$stmt = $db->prepare("SELECT value FROM hs_settings WHERE `key` = ?");
$stmt->execute([$key]);
$row  = $stmt->fetch();

echo json_encode(['value' => $row ? $row['value'] : null]);

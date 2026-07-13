<?php
require_once __DIR__ . '/../includes/db.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$db = getDB();
$category = isset($_GET['category']) ? trim($_GET['category']) : '';

if ($category && $category !== 'All') {
    $stmt = $db->prepare("SELECT id, title, category, description, image_path, link FROM hs_projects WHERE category = ? ORDER BY sort_order ASC, id ASC");
    $stmt->execute([$category]);
} else {
    $stmt = $db->query("SELECT id, title, category, description, image_path, link FROM hs_projects ORDER BY sort_order ASC, id ASC");
}

echo json_encode($stmt->fetchAll());

<?php
require_once __DIR__ . '/../includes/db.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$db = getDB();
$stmt = $db->query("SELECT id, icon, title, description FROM hs_services ORDER BY sort_order ASC, id ASC");
echo json_encode($stmt->fetchAll());

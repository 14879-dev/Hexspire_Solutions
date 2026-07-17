<?php
require_once __DIR__ . '/../includes/db.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$db = getDB();
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 100;
$stmt = $db->prepare("SELECT id, question, answer FROM hs_faqs ORDER BY sort_order ASC, id ASC LIMIT ?");
$stmt->execute([$limit]);
echo json_encode($stmt->fetchAll());

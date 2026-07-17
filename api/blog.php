<?php
require_once __DIR__ . '/../includes/db.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$db = getDB();
$slug = trim($_GET['slug'] ?? '');

if ($slug) {
    $stmt = $db->prepare("SELECT id, title, slug, content, image_path, created_at FROM hs_blog_posts WHERE slug=? AND is_published=1");
    $stmt->execute([$slug]);
    $post = $stmt->fetch();
    echo json_encode($post ?: null);
} else {
    $stmt = $db->query("SELECT id, title, slug, image_path, created_at FROM hs_blog_posts WHERE is_published=1 ORDER BY created_at DESC");
    echo json_encode($stmt->fetchAll());
}

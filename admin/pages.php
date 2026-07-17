<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/header.php';

$db = getDB();
$msg = ''; $msgType = '';

// Seed default pages if none exist
$count = $db->query("SELECT COUNT(*) FROM hs_pages")->fetchColumn();
if ($count == 0) {
    $db->exec("INSERT INTO hs_pages (title, slug, content) VALUES
        ('About Us', 'about-us', '<p>Hexspire Solutions is a passionate digital agency based in Pakistan, specializing in web development, SEO, and digital marketing. We help businesses build their online presence and grow in the digital world.</p>'),
        ('Privacy Policy', 'privacy-policy', '<h2>Privacy Policy</h2><p>Your privacy is important to us. This policy outlines how Hexspire Solutions collects, uses, and protects your personal information.</p><h3>Information We Collect</h3><p>We may collect your name, email address, and any information you submit through our contact form.</p><h3>How We Use Your Information</h3><p>We use your information solely to respond to your inquiries and improve our services. We never sell or share your data with third parties.</p><h3>Contact Us</h3><p>If you have any questions about this policy, please contact us through our website.</p>')");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id      = (int)($_POST['id'] ?? 0);
    $title   = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if ($id && $title) {
        $stmt = $db->prepare("UPDATE hs_pages SET title=?, content=? WHERE id=?");
        $stmt->execute([$title, $content, $id]);
        $msg = 'Page saved.'; $msgType = 'success';
    } else { $msg = 'Title is required.'; $msgType = 'error'; }
}

$pages = $db->query("SELECT * FROM hs_pages ORDER BY id ASC")->fetchAll();

$editing = null;
if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    foreach ($pages as $p) { if ($p['id'] == $editId) { $editing = $p; break; } }
}
if (!$editing && !empty($pages)) $editing = $pages[0];

adminHead('Pages', 'pages');
?>

<div class="page-header">
  <div>
    <h2 class="page-title">Pages</h2>
    <p class="page-sub">Manage dynamic pages like About Us and Privacy Policy.</p>
  </div>
</div>

<?php if ($msg): ?>
<div class="alert alert-<?= $msgType ?>"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<div style="display:grid;grid-template-columns:220px 1fr;gap:24px;align-items:start">
  <!-- Page List -->
  <div style="background:var(--navy-800);border-radius:12px;padding:12px">
    <?php foreach ($pages as $p): ?>
    <a href="?edit=<?= $p['id'] ?>" style="display:block;padding:10px 14px;border-radius:8px;color:<?= ($editing && $editing['id'] == $p['id']) ? 'var(--primary)' : 'var(--text-secondary)' ?>;background:<?= ($editing && $editing['id'] == $p['id']) ? 'rgba(var(--primary-rgb),0.1)' : 'transparent' ?>;text-decoration:none;font-weight:<?= ($editing && $editing['id'] == $p['id']) ? '600' : '400' ?>;transition:.2s">
      <?= htmlspecialchars($p['title']) ?>
    </a>
    <?php endforeach; ?>
  </div>

  <!-- Editor -->
  <?php if ($editing): ?>
  <div style="background:var(--navy-800);border-radius:12px;padding:24px">
    <h3 style="color:var(--text-primary);margin-bottom:16px">Editing: <?= htmlspecialchars($editing['title']) ?></h3>
    <p style="color:var(--text-muted);font-size:.85rem;margin-bottom:16px">Public URL: <code>/page.php?slug=<?= $editing['slug'] ?></code></p>
    <form method="POST">
      <input type="hidden" name="id" value="<?= $editing['id'] ?>">
      <div class="form-group">
        <label>Page Title</label>
        <input type="text" name="title" value="<?= htmlspecialchars($editing['title']) ?>" required>
      </div>
      <div class="form-group">
        <label>Content (HTML allowed)</label>
        <textarea name="content" rows="16" style="font-family:monospace;font-size:.88rem"><?= htmlspecialchars($editing['content']) ?></textarea>
      </div>
      <button type="submit" class="btn-primary">Save Page</button>
    </form>
  </div>
  <?php endif; ?>
</div>

<?php adminFoot(); ?>

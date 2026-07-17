<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/header.php';

$db = getDB();
$msg = ''; $msgType = '';

function slugify(string $text): string {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action  = $_POST['action'] ?? '';
    $id      = (int)($_POST['id'] ?? 0);
    $title   = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $pub     = isset($_POST['is_published']) ? 1 : 0;

    $imagePath = '';
    if ($id) {
        $ex = $db->prepare("SELECT image_path FROM hs_blog_posts WHERE id=?");
        $ex->execute([$id]);
        $imagePath = $ex->fetchColumn() ?: '';
    }
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmp  = $_FILES['image']['tmp_name'];
        $name = time() . '_' . preg_replace('/[^a-zA-Z0-9.\-_]/', '', $_FILES['image']['name']);
        $dir  = __DIR__ . '/../uploads/blog';
        if (!is_dir($dir)) mkdir($dir, 0777, true);
        if (move_uploaded_file($tmp, "$dir/$name")) $imagePath = 'uploads/blog/' . $name;
    }

    if ($action === 'add' && $title) {
        $slug = slugify($title);
        // ensure unique slug
        $check = $db->prepare("SELECT COUNT(*) FROM hs_blog_posts WHERE slug=?");
        $check->execute([$slug]);
        if ($check->fetchColumn() > 0) $slug .= '-' . time();

        $stmt = $db->prepare("INSERT INTO hs_blog_posts (title, slug, content, image_path, is_published) VALUES (?,?,?,?,?)");
        $stmt->execute([$title, $slug, $content, $imagePath, $pub]);
        $msg = 'Post published.'; $msgType = 'success';

    } elseif ($action === 'edit' && $title && $id) {
        $stmt = $db->prepare("UPDATE hs_blog_posts SET title=?, content=?, image_path=?, is_published=? WHERE id=?");
        $stmt->execute([$title, $content, $imagePath, $pub, $id]);
        $msg = 'Post updated.'; $msgType = 'success';

    } elseif ($action === 'delete') {
        $db->prepare("DELETE FROM hs_blog_posts WHERE id=?")->execute([$id]);
        $msg = 'Post deleted.'; $msgType = 'success';
    }
}

$posts = $db->query("SELECT * FROM hs_blog_posts ORDER BY created_at DESC")->fetchAll();

$editing = null;
if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    foreach ($posts as $p) { if ($p['id'] == $editId) { $editing = $p; break; } }
}

adminHead('Blog Posts', 'blog');
?>

<div class="page-header">
  <div>
    <h2 class="page-title">Blog</h2>
    <p class="page-sub">Write and manage blog posts for the public site.</p>
  </div>
  <button class="btn-primary" onclick="showSection('write-section')" id="new-post-btn">+ New Post</button>
</div>

<?php if ($msg): ?>
<div class="alert alert-<?= $msgType ?>"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<!-- Write / Edit Section -->
<div id="write-section" style="display:<?= $editing ? 'block' : 'none' ?>;background:var(--navy-800);border-radius:12px;padding:24px;margin-bottom:24px">
  <h3 style="margin-bottom:16px;color:var(--text-primary)"><?= $editing ? 'Edit Post' : 'New Blog Post' ?></h3>
  <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="<?= $editing ? 'edit' : 'add' ?>">
    <?php if ($editing): ?><input type="hidden" name="id" value="<?= $editing['id'] ?>"><?php endif; ?>
    <div class="form-group">
      <label>Title *</label>
      <input type="text" name="title" required value="<?= htmlspecialchars($editing['title'] ?? '') ?>" placeholder="Post title…">
    </div>
    <div class="form-group">
      <label>Cover Image</label>
      <?php if ($editing && $editing['image_path']): ?>
        <div style="margin-bottom:8px"><img src="../<?= htmlspecialchars($editing['image_path']) ?>" style="height:80px;border-radius:6px"></div>
      <?php endif; ?>
      <input type="file" name="image" accept="image/*">
    </div>
    <div class="form-group">
      <label>Content (HTML allowed)</label>
      <textarea name="content" rows="12" placeholder="Write your blog post here… HTML is supported."><?= htmlspecialchars($editing['content'] ?? '') ?></textarea>
    </div>
    <div class="form-group" style="display:flex;align-items:center;gap:10px">
      <input type="checkbox" name="is_published" id="is_pub" value="1" <?= (!$editing || $editing['is_published']) ? 'checked' : '' ?>>
      <label for="is_pub" style="margin:0">Published</label>
    </div>
    <div style="display:flex;gap:12px;margin-top:12px">
      <button type="submit" class="btn-primary">Save Post</button>
      <button type="button" class="btn-cancel" onclick="showSection(null)">Cancel</button>
    </div>
  </form>
</div>

<!-- Posts Table -->
<div class="table-wrap" id="posts-table">
  <table class="admin-table">
    <thead><tr><th>#</th><th>Image</th><th>Title</th><th>Slug</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>
    <tbody>
      <?php if (empty($posts)): ?>
      <tr><td colspan="7" class="empty-cell">No blog posts yet. Write your first one!</td></tr>
      <?php else: ?>
      <?php foreach ($posts as $i => $p): ?>
      <tr>
        <td><?= $i+1 ?></td>
        <td><?php if ($p['image_path']): ?><img src="../<?= htmlspecialchars($p['image_path']) ?>" style="width:50px;height:36px;object-fit:cover;border-radius:4px"><?php else: ?>—<?php endif; ?></td>
        <td><strong><?= htmlspecialchars($p['title']) ?></strong></td>
        <td><code><?= htmlspecialchars($p['slug']) ?></code></td>
        <td><span style="color:<?= $p['is_published'] ? 'var(--success)' : 'var(--text-muted)' ?>"><?= $p['is_published'] ? 'Published' : 'Draft' ?></span></td>
        <td><?= date('d M Y', strtotime($p['created_at'])) ?></td>
        <td class="td-actions">
          <a href="?edit=<?= $p['id'] ?>" class="btn-edit">Edit</a>
          <form method="POST" style="display:inline" onsubmit="return confirm('Delete this post?')">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?= $p['id'] ?>">
            <button type="submit" class="btn-delete">Delete</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<script>
function showSection(id) {
  const ws = document.getElementById('write-section');
  ws.style.display = id ? 'block' : 'none';
}
</script>

<?php adminFoot(); ?>

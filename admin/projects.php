<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/header.php';

$db = getDB();
$msg = ''; $msgType = '';

// Handle POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add' || $action === 'edit') {
        $id       = (int)($_POST['id'] ?? 0);
        $title    = trim($_POST['title'] ?? '');
        $category = trim($_POST['category'] ?? 'Web');
        $desc     = trim($_POST['description'] ?? '');
        $link     = trim($_POST['link'] ?? '');
        $order    = (int)($_POST['sort_order'] ?? 0);
        $imagePath = '';

        // Handle image upload
        if (!empty($_FILES['image']['name'])) {
            $allowed = ['image/jpeg','image/jpg','image/png','image/gif','image/webp'];
            if (in_array($_FILES['image']['type'], $allowed) && $_FILES['image']['size'] < 5*1024*1024) {
                $ext  = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $name = 'proj_' . time() . '_' . rand(1000,9999) . '.' . strtolower($ext);
                $dest = __DIR__ . '/../uploads/projects/' . $name;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                    $imagePath = 'uploads/projects/' . $name;
                }
            } else {
                $msg = 'Invalid image. Use JPG/PNG/WEBP under 5MB.'; $msgType = 'error';
            }
        }

        if ($title && !$msg) {
            if ($action === 'add') {
                $stmt = $db->prepare("INSERT INTO hs_projects (title, category, description, image_path, link, sort_order) VALUES (?,?,?,?,?,?)");
                $stmt->execute([$title, $category, $desc, $imagePath, $link, $order]);
                $msg = 'Project added successfully.'; $msgType = 'success';
            } else {
                // Keep existing image if none uploaded
                if ($imagePath) {
                    $stmt = $db->prepare("UPDATE hs_projects SET title=?, category=?, description=?, image_path=?, link=?, sort_order=? WHERE id=?");
                    $stmt->execute([$title, $category, $desc, $imagePath, $link, $order, $id]);
                } else {
                    $stmt = $db->prepare("UPDATE hs_projects SET title=?, category=?, description=?, link=?, sort_order=? WHERE id=?");
                    $stmt->execute([$title, $category, $desc, $link, $order, $id]);
                }
                $msg = 'Project updated successfully.'; $msgType = 'success';
            }
        } elseif (!$msg) {
            $msg = 'Title is required.'; $msgType = 'error';
        }
    }

    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        // Delete image file
        $row = $db->prepare("SELECT image_path FROM hs_projects WHERE id=?");
        $row->execute([$id]);
        $imgPath = $row->fetchColumn();
        if ($imgPath) {
            $fullPath = __DIR__ . '/../' . $imgPath;
            if (file_exists($fullPath)) unlink($fullPath);
        }
        $db->prepare("DELETE FROM hs_projects WHERE id=?")->execute([$id]);
        $msg = 'Project deleted.'; $msgType = 'success';
    }
}

$projects = $db->query("SELECT * FROM hs_projects ORDER BY sort_order ASC, id ASC")->fetchAll();
$categories = ['Web', 'SEO', 'App', 'Design', 'Other'];

adminHead('Projects', 'projects');
?>

<div class="page-header">
  <div>
    <h2 class="page-title">Projects</h2>
    <p class="page-sub">Manage portfolio projects shown on the public site.</p>
  </div>
  <button class="btn-primary" onclick="showModal('add-modal')" id="add-project-btn">+ Add Project</button>
</div>

<?php if ($msg): ?>
<div class="alert alert-<?= $msgType ?>"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<div class="table-wrap">
  <table class="admin-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Image</th>
        <th>Title</th>
        <th>Category</th>
        <th>Link</th>
        <th>Order</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($projects)): ?>
      <tr><td colspan="7" class="empty-cell">No projects yet. Add your first one!</td></tr>
      <?php else: ?>
      <?php foreach ($projects as $i => $p): ?>
      <tr>
        <td><?= $i+1 ?></td>
        <td>
          <?php if ($p['image_path']): ?>
            <img src="/Hexspire_Solution/<?= htmlspecialchars($p['image_path']) ?>" alt="" style="width:60px;height:40px;object-fit:cover;border-radius:6px">
          <?php else: ?>
            <span style="color:var(--muted)">—</span>
          <?php endif; ?>
        </td>
        <td><strong><?= htmlspecialchars($p['title']) ?></strong></td>
        <td><span class="pill pill-blue"><?= htmlspecialchars($p['category']) ?></span></td>
        <td>
          <?php if ($p['link']): ?>
            <a href="<?= htmlspecialchars($p['link']) ?>" target="_blank" style="color:var(--orange)">↗ Link</a>
          <?php else: echo '—'; endif; ?>
        </td>
        <td><?= $p['sort_order'] ?></td>
        <td class="td-actions">
          <button class="btn-edit" onclick='editProject(<?= htmlspecialchars(json_encode($p)) ?>)' id="edit-proj-<?= $p['id'] ?>">Edit</button>
          <form method="POST" enctype="multipart/form-data" style="display:inline" onsubmit="return confirm('Delete this project?')">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?= $p['id'] ?>">
            <button type="submit" class="btn-delete" id="del-proj-<?= $p['id'] ?>">Delete</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- Add Modal -->
<div class="modal-overlay" id="add-modal" role="dialog" aria-modal="true" aria-labelledby="add-proj-title">
  <div class="modal modal-lg">
    <div class="modal-header">
      <h3 id="add-proj-title">Add Project</h3>
      <button class="modal-close" onclick="hideModal('add-modal')">✕</button>
    </div>
    <form method="POST" enctype="multipart/form-data">
      <input type="hidden" name="action" value="add">
      <div class="form-row-2">
        <div class="form-group">
          <label>Title *</label>
          <input type="text" name="title" required placeholder="Project title">
        </div>
        <div class="form-group">
          <label>Category</label>
          <select name="category" class="form-select">
            <?php foreach ($categories as $cat): ?>
            <option><?= $cat ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea name="description" rows="3" placeholder="Brief project description…"></textarea>
      </div>
      <div class="form-row-2">
        <div class="form-group">
          <label>Project Image</label>
          <input type="file" name="image" accept="image/*" class="file-input">
          <small>JPG, PNG, WEBP — max 5MB</small>
        </div>
        <div class="form-group">
          <label>Project Link (URL)</label>
          <input type="url" name="link" placeholder="https://example.com">
        </div>
      </div>
      <div class="form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="0" min="0">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-cancel" onclick="hideModal('add-modal')">Cancel</button>
        <button type="submit" class="btn-primary" id="add-proj-submit">Add Project</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal-overlay" id="edit-modal" role="dialog" aria-modal="true" aria-labelledby="edit-proj-title">
  <div class="modal modal-lg">
    <div class="modal-header">
      <h3 id="edit-proj-title">Edit Project</h3>
      <button class="modal-close" onclick="hideModal('edit-modal')">✕</button>
    </div>
    <form method="POST" enctype="multipart/form-data">
      <input type="hidden" name="action" value="edit">
      <input type="hidden" name="id" id="ep-id">
      <div class="form-row-2">
        <div class="form-group">
          <label>Title *</label>
          <input type="text" name="title" id="ep-title" required>
        </div>
        <div class="form-group">
          <label>Category</label>
          <select name="category" id="ep-category" class="form-select">
            <?php foreach ($categories as $cat): ?>
            <option><?= $cat ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea name="description" id="ep-desc" rows="3"></textarea>
      </div>
      <div class="form-row-2">
        <div class="form-group">
          <label>Replace Image</label>
          <input type="file" name="image" accept="image/*" class="file-input">
          <small id="ep-current-img"></small>
        </div>
        <div class="form-group">
          <label>Project Link</label>
          <input type="url" name="link" id="ep-link">
        </div>
      </div>
      <div class="form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" id="ep-order" min="0">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-cancel" onclick="hideModal('edit-modal')">Cancel</button>
        <button type="submit" class="btn-primary" id="edit-proj-submit">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<script>
function editProject(data) {
  document.getElementById('ep-id').value       = data.id;
  document.getElementById('ep-title').value    = data.title;
  document.getElementById('ep-desc').value     = data.description || '';
  document.getElementById('ep-link').value     = data.link || '';
  document.getElementById('ep-order').value    = data.sort_order;
  document.getElementById('ep-category').value = data.category;
  document.getElementById('ep-current-img').textContent = data.image_path ? 'Current: ' + data.image_path : 'No image yet';
  showModal('edit-modal');
}
</script>

<?php adminFoot(); ?>

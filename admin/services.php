<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/header.php';

$db = getDB();
$msg = '';
$msgType = '';

// Supported icons list
$iconOptions = ['globe','search','smartphone','bar-chart-2','shield-check','zap','code','layout','image','mail','phone','map-pin','bar-chart-2','trending-up','star','heart','settings','tool'];

// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add' || $action === 'edit') {
        $id    = (int)($_POST['id'] ?? 0);
        $icon  = trim($_POST['icon'] ?? 'zap');
        $title = trim($_POST['title'] ?? '');
        $desc  = trim($_POST['description'] ?? '');
        $order = (int)($_POST['sort_order'] ?? 0);

        $imagePath = '';
        if ($action === 'edit') {
            $existing = $db->query("SELECT image_path FROM hs_services WHERE id = " . $id)->fetchColumn();
            $imagePath = $existing ?: '';
        }

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $tmp  = $_FILES['image']['tmp_name'];
            $name = time() . '_' . preg_replace('/[^a-zA-Z0-9.\-_]/', '', $_FILES['image']['name']);
            $dir  = __DIR__ . '/../uploads/services';
            if (!is_dir($dir)) mkdir($dir, 0777, true);
            if (move_uploaded_file($tmp, "$dir/$name")) {
                $imagePath = 'uploads/services/' . $name;
            }
        }

        if ($title) {
            if ($action === 'add') {
                $stmt = $db->prepare("INSERT INTO hs_services (icon, title, description, image_path, sort_order) VALUES (?,?,?,?,?)");
                $stmt->execute([$icon, $title, $desc, $imagePath, $order]);
                $msg = 'Service added successfully.'; $msgType = 'success';
            } else {
                $stmt = $db->prepare("UPDATE hs_services SET icon=?, title=?, description=?, image_path=?, sort_order=? WHERE id=?");
                $stmt->execute([$icon, $title, $desc, $imagePath, $order, $id]);
                $msg = 'Service updated successfully.'; $msgType = 'success';
            }
        } else {
            $msg = 'Title is required.'; $msgType = 'error';
        }
    }

    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        $db->prepare("DELETE FROM hs_services WHERE id=?")->execute([$id]);
        $msg = 'Service deleted.'; $msgType = 'success';
    }
}

$services = $db->query("SELECT * FROM hs_services ORDER BY sort_order ASC, id ASC")->fetchAll();

// Edit mode
$editing = null;
if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    foreach ($services as $s) {
        if ($s['id'] == $editId) { $editing = $s; break; }
    }
}

adminHead('Services', 'services');
?>

<div class="page-header">
  <div>
    <h2 class="page-title">Services</h2>
    <p class="page-sub">Manage the services displayed on the public site.</p>
  </div>
  <button class="btn-primary" onclick="showModal('add-modal')" id="add-service-btn">+ Add Service</button>
</div>

<?php if ($msg): ?>
<div class="alert alert-<?= $msgType ?>"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<div class="table-wrap">
  <table class="admin-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Image / Icon</th>
        <th>Title</th>
        <th>Description</th>
        <th>Order</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($services)): ?>
      <tr><td colspan="6" class="empty-cell">No services yet. Add your first one!</td></tr>
      <?php else: ?>
      <?php foreach ($services as $i => $svc): ?>
      <tr>
        <td><?= $i+1 ?></td>
        <td>
          <?php if (!empty($svc['image_path'])): ?>
            <img src="../<?= htmlspecialchars($svc['image_path']) ?>" alt="" style="width:40px;height:40px;object-fit:cover;border-radius:4px">
          <?php else: ?>
            <code><?= htmlspecialchars($svc['icon']) ?></code>
          <?php endif; ?>
        </td>
        <td><strong><?= htmlspecialchars($svc['title']) ?></strong></td>
        <td class="td-ellipsis"><?= htmlspecialchars($svc['description']) ?></td>
        <td><?= $svc['sort_order'] ?></td>
        <td class="td-actions">
          <button class="btn-edit" onclick="editService(<?= htmlspecialchars(json_encode($svc)) ?>)" id="edit-svc-<?= $svc['id'] ?>">Edit</button>
          <form method="POST" style="display:inline" onsubmit="return confirm('Delete this service?')">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?= $svc['id'] ?>">
            <button type="submit" class="btn-delete" id="del-svc-<?= $svc['id'] ?>">Delete</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- Add Modal -->
<div class="modal-overlay" id="add-modal" role="dialog" aria-modal="true" aria-labelledby="add-modal-title">
  <div class="modal">
    <div class="modal-header">
      <h3 id="add-modal-title">Add Service</h3>
      <button class="modal-close" onclick="hideModal('add-modal')" aria-label="Close">✕</button>
    </div>
    <form method="POST" enctype="multipart/form-data">
      <input type="hidden" name="action" value="add">
      <div class="form-group">
        <label for="add-image">Service Image</label>
        <input type="file" name="image" id="add-image" accept="image/*">
        <small>Upload an image for the service container (recommended over icon).</small>
      </div>
      <div class="form-group">
        <label for="add-icon">Icon Name</label>
        <select name="icon" id="add-icon" class="form-select">
          <?php foreach ($iconOptions as $ic): ?>
          <option value="<?= $ic ?>"><?= $ic ?></option>
          <?php endforeach; ?>
        </select>
        <small>Icon names from Lucide icons (e.g. globe, zap, search)</small>
      </div>
      <div class="form-group">
        <label for="add-title">Title *</label>
        <input type="text" name="title" id="add-title" required placeholder="e.g. Web Development">
      </div>
      <div class="form-group">
        <label for="add-desc">Description</label>
        <textarea name="description" id="add-desc" rows="3" placeholder="Short description of the service…"></textarea>
      </div>
      <div class="form-group">
        <label for="add-order">Sort Order</label>
        <input type="number" name="sort_order" id="add-order" value="0" min="0">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-cancel" onclick="hideModal('add-modal')">Cancel</button>
        <button type="submit" class="btn-primary" id="add-svc-submit">Add Service</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal-overlay" id="edit-modal" role="dialog" aria-modal="true" aria-labelledby="edit-modal-title">
  <div class="modal">
    <div class="modal-header">
      <h3 id="edit-modal-title">Edit Service</h3>
      <button class="modal-close" onclick="hideModal('edit-modal')" aria-label="Close">✕</button>
    </div>
    <form method="POST" enctype="multipart/form-data">
      <input type="hidden" name="action" value="edit">
      <input type="hidden" name="id" id="edit-id">
      <div class="form-group">
        <label>Current Image</label>
        <div id="edit-image-preview" style="margin-bottom:8px">None</div>
        <label for="edit-image">Upload New Image</label>
        <input type="file" name="image" id="edit-image" accept="image/*">
      </div>
      <div class="form-group">
        <label for="edit-icon">Icon Name</label>
        <select name="icon" id="edit-icon" class="form-select">
          <?php foreach ($iconOptions as $ic): ?>
          <option value="<?= $ic ?>"><?= $ic ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="edit-title">Title *</label>
        <input type="text" name="title" id="edit-title" required>
      </div>
      <div class="form-group">
        <label for="edit-desc">Description</label>
        <textarea name="description" id="edit-desc" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="edit-order">Sort Order</label>
        <input type="number" name="sort_order" id="edit-order" min="0">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-cancel" onclick="hideModal('edit-modal')">Cancel</button>
        <button type="submit" class="btn-primary" id="edit-svc-submit">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<script>
function editService(data) {
  document.getElementById('edit-id').value    = data.id;
  document.getElementById('edit-icon').value  = data.icon;
  document.getElementById('edit-title').value = data.title;
  document.getElementById('edit-desc').value  = data.description;
  document.getElementById('edit-order').value = data.sort_order;
  
  const preview = document.getElementById('edit-image-preview');
  if (data.image_path) {
    preview.innerHTML = `<img src="../${data.image_path}" style="height:50px;border-radius:4px">`;
  } else {
    preview.innerHTML = 'None';
  }

  showModal('edit-modal');
}
</script>

<?php adminFoot(); ?>

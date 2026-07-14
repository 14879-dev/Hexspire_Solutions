<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/header.php';

$db = getDB();
$msg = ''; $msgType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add' || $action === 'edit') {
        $id       = (int)($_POST['id'] ?? 0);
        $name     = trim($_POST['name'] ?? '');
        $role     = trim($_POST['role'] ?? '');
        $linkedin = trim($_POST['linkedin'] ?? '');
        $twitter  = trim($_POST['twitter'] ?? '');
        $github   = trim($_POST['github'] ?? '');
        $order    = (int)($_POST['sort_order'] ?? 0);
        $photoPath = '';

        if (!empty($_FILES['photo']['name'])) {
            $allowed = ['image/jpeg','image/jpg','image/png','image/gif','image/webp'];
            if (in_array($_FILES['photo']['type'], $allowed) && $_FILES['photo']['size'] < 3*1024*1024) {
                $ext  = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $fname = 'team_' . time() . '_' . rand(1000,9999) . '.' . strtolower($ext);
                $dest = __DIR__ . '/../uploads/team/' . $fname;
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $dest)) {
                    $photoPath = 'uploads/team/' . $fname;
                }
            } else {
                $msg = 'Invalid photo. Use JPG/PNG/WEBP under 3MB.'; $msgType = 'error';
            }
        }

        if ($name && !$msg) {
            if ($action === 'add') {
                $stmt = $db->prepare("INSERT INTO hs_team (name, role, photo_path, linkedin, twitter, github, sort_order) VALUES (?,?,?,?,?,?,?)");
                $stmt->execute([$name, $role, $photoPath, $linkedin, $twitter, $github, $order]);
                $msg = 'Team member added.'; $msgType = 'success';
            } else {
                if ($photoPath) {
                    $stmt = $db->prepare("UPDATE hs_team SET name=?, role=?, photo_path=?, linkedin=?, twitter=?, github=?, sort_order=? WHERE id=?");
                    $stmt->execute([$name, $role, $photoPath, $linkedin, $twitter, $github, $order, $id]);
                } else {
                    $stmt = $db->prepare("UPDATE hs_team SET name=?, role=?, linkedin=?, twitter=?, github=?, sort_order=? WHERE id=?");
                    $stmt->execute([$name, $role, $linkedin, $twitter, $github, $order, $id]);
                }
                $msg = 'Team member updated.'; $msgType = 'success';
            }
        } elseif (!$msg) {
            $msg = 'Name is required.'; $msgType = 'error';
        }
    }

    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        $row = $db->prepare("SELECT photo_path FROM hs_team WHERE id=?");
        $row->execute([$id]);
        $photo = $row->fetchColumn();
        if ($photo) {
            $f = __DIR__ . '/../' . $photo;
            if (file_exists($f)) unlink($f);
        }
        $db->prepare("DELETE FROM hs_team WHERE id=?")->execute([$id]);
        $msg = 'Team member deleted.'; $msgType = 'success';
    }
}

$team = $db->query("SELECT * FROM hs_team ORDER BY sort_order ASC, id ASC")->fetchAll();

adminHead('Team', 'team');
?>

<div class="page-header">
  <div>
    <h2 class="page-title">Team</h2>
    <p class="page-sub">Manage team members displayed on the public site.</p>
  </div>
  <button class="btn-primary" onclick="showModal('add-modal')" id="add-team-btn">+ Add Member</button>
</div>

<?php if ($msg): ?>
<div class="alert alert-<?= $msgType ?>"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<!-- Team Cards Grid -->
<div class="admin-team-grid">
  <?php if (empty($team)): ?>
  <div class="empty-state" style="grid-column:1/-1">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="40" height="40"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
    <p>No team members yet.</p>
  </div>
  <?php else: ?>
  <?php foreach ($team as $m): ?>
  <div class="team-admin-card">
    <div class="team-admin-photo">
      <?php if ($m['photo_path']): ?>
        <img src="../<?= htmlspecialchars($m['photo_path']) ?>" alt="<?= htmlspecialchars($m['name']) ?>">
      <?php else: ?>
        <div class="team-admin-initials"><?= strtoupper(substr($m['name'],0,1)) ?></div>
      <?php endif; ?>
    </div>
    <div class="team-admin-info">
      <strong><?= htmlspecialchars($m['name']) ?></strong>
      <span><?= htmlspecialchars($m['role']) ?></span>
    </div>
    <div class="team-admin-actions">
      <button class="btn-edit" onclick='editMember(<?= htmlspecialchars(json_encode($m)) ?>)' id="edit-team-<?= $m['id'] ?>">Edit</button>
      <form method="POST" enctype="multipart/form-data" onsubmit="return confirm('Delete this team member?')" style="display:inline">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="id" value="<?= $m['id'] ?>">
        <button type="submit" class="btn-delete" id="del-team-<?= $m['id'] ?>">Delete</button>
      </form>
    </div>
  </div>
  <?php endforeach; ?>
  <?php endif; ?>
</div>

<!-- Add Modal -->
<div class="modal-overlay" id="add-modal" role="dialog" aria-modal="true" aria-labelledby="add-team-title">
  <div class="modal modal-lg">
    <div class="modal-header">
      <h3 id="add-team-title">Add Team Member</h3>
      <button class="modal-close" onclick="hideModal('add-modal')">✕</button>
    </div>
    <form method="POST" enctype="multipart/form-data">
      <input type="hidden" name="action" value="add">
      <div class="form-row-2">
        <div class="form-group">
          <label>Full Name *</label>
          <input type="text" name="name" required placeholder="e.g. Ali Hassan">
        </div>
        <div class="form-group">
          <label>Role / Title</label>
          <input type="text" name="role" placeholder="e.g. Frontend Developer">
        </div>
      </div>
      <div class="form-group">
        <label>Photo</label>
        <input type="file" name="photo" accept="image/*" class="file-input">
        <small>JPG, PNG, WEBP — max 3MB. Square images work best.</small>
      </div>
      <div class="form-row-3">
        <div class="form-group">
          <label>LinkedIn URL</label>
          <input type="url" name="linkedin" placeholder="https://linkedin.com/in/…">
        </div>
        <div class="form-group">
          <label>Twitter URL</label>
          <input type="url" name="twitter" placeholder="https://twitter.com/…">
        </div>
        <div class="form-group">
          <label>GitHub URL</label>
          <input type="url" name="github" placeholder="https://github.com/…">
        </div>
      </div>
      <div class="form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="0" min="0">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-cancel" onclick="hideModal('add-modal')">Cancel</button>
        <button type="submit" class="btn-primary" id="add-team-submit">Add Member</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal-overlay" id="edit-modal" role="dialog" aria-modal="true" aria-labelledby="edit-team-title">
  <div class="modal modal-lg">
    <div class="modal-header">
      <h3 id="edit-team-title">Edit Team Member</h3>
      <button class="modal-close" onclick="hideModal('edit-modal')">✕</button>
    </div>
    <form method="POST" enctype="multipart/form-data">
      <input type="hidden" name="action" value="edit">
      <input type="hidden" name="id" id="em-id">
      <div class="form-row-2">
        <div class="form-group">
          <label>Full Name *</label>
          <input type="text" name="name" id="em-name" required>
        </div>
        <div class="form-group">
          <label>Role / Title</label>
          <input type="text" name="role" id="em-role">
        </div>
      </div>
      <div class="form-group">
        <label>Replace Photo</label>
        <input type="file" name="photo" accept="image/*" class="file-input">
        <small id="em-current-photo"></small>
      </div>
      <div class="form-row-3">
        <div class="form-group">
          <label>LinkedIn</label>
          <input type="url" name="linkedin" id="em-linkedin">
        </div>
        <div class="form-group">
          <label>Twitter</label>
          <input type="url" name="twitter" id="em-twitter">
        </div>
        <div class="form-group">
          <label>GitHub</label>
          <input type="url" name="github" id="em-github">
        </div>
      </div>
      <div class="form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" id="em-order" min="0">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-cancel" onclick="hideModal('edit-modal')">Cancel</button>
        <button type="submit" class="btn-primary" id="edit-team-submit">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<script>
function editMember(data) {
  document.getElementById('em-id').value       = data.id;
  document.getElementById('em-name').value     = data.name;
  document.getElementById('em-role').value     = data.role || '';
  document.getElementById('em-linkedin').value = data.linkedin || '';
  document.getElementById('em-twitter').value  = data.twitter || '';
  document.getElementById('em-github').value   = data.github || '';
  document.getElementById('em-order').value    = data.sort_order;
  document.getElementById('em-current-photo').textContent = data.photo_path ? 'Current: ' + data.photo_path : 'No photo uploaded';
  showModal('edit-modal');
}
</script>

<?php adminFoot(); ?>

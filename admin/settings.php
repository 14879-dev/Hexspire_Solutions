<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/header.php';

$db = getDB();
$msg = ''; $msgType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // Upload logo
    if ($action === 'logo') {
        if (!empty($_FILES['logo']['name'])) {
            $allowed = ['image/jpeg','image/jpg','image/png','image/gif','image/webp','image/svg+xml'];
            if (in_array($_FILES['logo']['type'], $allowed) && $_FILES['logo']['size'] < 2*1024*1024) {
                $ext   = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
                $fname = 'logo.' . strtolower($ext);
                $dir   = __DIR__ . '/../uploads/logo/';
                if (!is_dir($dir)) mkdir($dir, 0755, true);
                if (move_uploaded_file($_FILES['logo']['tmp_name'], $dir . $fname)) {
                    $path = 'uploads/logo/' . $fname;
                    $db->prepare("INSERT INTO hs_settings (`key`, value) VALUES ('logo_path', ?) ON DUPLICATE KEY UPDATE value=?")->execute([$path, $path]);
                    $msg = 'Logo updated successfully.'; $msgType = 'success';
                } else {
                    $msg = 'Failed to move uploaded file.'; $msgType = 'error';
                }
            } else {
                $msg = 'Invalid file. Use JPG/PNG/SVG/WEBP under 2MB.'; $msgType = 'error';
            }
        } else {
            $msg = 'Please select a logo file.'; $msgType = 'error';
        }
    }

    // Change password
    if ($action === 'password') {
        $current = $_POST['current_password'] ?? '';
        $new     = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        $storedHash = $db->query("SELECT value FROM hs_settings WHERE `key`='admin_password_hash'")->fetchColumn();

        if (!password_verify($current, $storedHash)) {
            $msg = 'Current password is incorrect.'; $msgType = 'error';
        } elseif (strlen($new) < 8) {
            $msg = 'New password must be at least 8 characters.'; $msgType = 'error';
        } elseif ($new !== $confirm) {
            $msg = 'New passwords do not match.'; $msgType = 'error';
        } else {
            $hash = password_hash($new, PASSWORD_BCRYPT);
            $db->prepare("UPDATE hs_settings SET value=? WHERE `key`='admin_password_hash'")->execute([$hash]);
            $msg = 'Password changed successfully.'; $msgType = 'success';
        }
    }
}

$logoPath = $db->query("SELECT value FROM hs_settings WHERE `key`='logo_path'")->fetchColumn();

adminHead('Settings', 'settings');
?>

<div class="page-header">
  <div>
    <h2 class="page-title">Settings</h2>
    <p class="page-sub">Manage your site logo and admin credentials.</p>
  </div>
</div>

<?php if ($msg): ?>
<div class="alert alert-<?= $msgType ?>"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<div class="settings-grid">

  <!-- Logo Upload -->
  <div class="settings-card">
    <h3 class="settings-card-title">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="18" height="18"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
      Site Logo
    </h3>
    <p class="settings-card-sub">Upload the logo displayed in the top-center glass badge on the public site.</p>

    <div class="logo-preview-wrap">
      <?php if ($logoPath): ?>
        <img src="/Hexspire_Solution/<?= htmlspecialchars($logoPath) ?>" alt="Current Logo" id="logo-preview" style="max-width:120px;max-height:120px;border-radius:12px;object-fit:contain;background:var(--navy-700);padding:8px">
      <?php else: ?>
        <div id="logo-preview" class="logo-preview-placeholder">
          <span>H</span>
          <small>No logo uploaded</small>
        </div>
      <?php endif; ?>
    </div>

    <form method="POST" enctype="multipart/form-data" id="logo-form">
      <input type="hidden" name="action" value="logo">
      <div class="form-group" style="margin-top:20px">
        <label for="logo-file">Choose Logo File</label>
        <input type="file" name="logo" id="logo-file" accept="image/*" class="file-input" required onchange="previewLogo(this)">
        <small>Accepted: JPG, PNG, SVG, WEBP — max 2MB. Square/circular images recommended.</small>
      </div>
      <button type="submit" class="btn-primary" id="logo-submit" style="margin-top:8px">Upload Logo</button>
    </form>
  </div>

  <!-- Change Password -->
  <div class="settings-card">
    <h3 class="settings-card-title">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="18" height="18"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
      Change Password
    </h3>
    <p class="settings-card-sub">Update the admin panel login password.</p>

    <form method="POST" id="password-form" style="margin-top:20px">
      <input type="hidden" name="action" value="password">
      <div class="form-group">
        <label for="current-pw">Current Password</label>
        <input type="password" name="current_password" id="current-pw" required placeholder="••••••••" autocomplete="current-password">
      </div>
      <div class="form-group">
        <label for="new-pw">New Password</label>
        <input type="password" name="new_password" id="new-pw" required placeholder="Minimum 8 characters" autocomplete="new-password">
      </div>
      <div class="form-group">
        <label for="confirm-pw">Confirm New Password</label>
        <input type="password" name="confirm_password" id="confirm-pw" required placeholder="Repeat new password" autocomplete="new-password">
      </div>
      <button type="submit" class="btn-primary" id="pw-submit">Change Password</button>
    </form>
  </div>

</div>

<script>
function previewLogo(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      const preview = document.getElementById('logo-preview');
      if (preview.tagName === 'IMG') {
        preview.src = e.target.result;
      } else {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.id  = 'logo-preview';
        img.style.cssText = 'max-width:120px;max-height:120px;border-radius:12px;object-fit:contain;background:var(--navy-700);padding:8px';
        preview.replaceWith(img);
      }
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>

<?php adminFoot(); ?>

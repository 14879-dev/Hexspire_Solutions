<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/header.php';

$db = getDB();
$msg = ''; $msgType = '';

// Mark as read
if (isset($_GET['read'])) {
    $id = (int)$_GET['read'];
    $db->prepare("UPDATE hs_messages SET is_read=1 WHERE id=?")->execute([$id]);
    header('Location: /Hexspire_Solution/admin/messages.php');
    exit;
}

// Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    $id = (int)($_POST['id'] ?? 0);
    $db->prepare("DELETE FROM hs_messages WHERE id=?")->execute([$id]);
    header('Location: /Hexspire_Solution/admin/messages.php');
    exit;
}

// View single message
$viewing = null;
if (isset($_GET['view'])) {
    $id = (int)$_GET['view'];
    $stmt = $db->prepare("SELECT * FROM hs_messages WHERE id=?");
    $stmt->execute([$id]);
    $viewing = $stmt->fetch();
    if ($viewing && !$viewing['is_read']) {
        $db->prepare("UPDATE hs_messages SET is_read=1 WHERE id=?")->execute([$id]);
        $viewing['is_read'] = 1;
    }
}

$messages = $db->query("SELECT * FROM hs_messages ORDER BY created_at DESC")->fetchAll();
$unread   = array_sum(array_column($messages, 'is_read') === array_fill(0, count($messages), 0) ? [] : array_map(fn($m) => (int)!$m['is_read'], $messages));
$unread   = count(array_filter($messages, fn($m) => !$m['is_read']));

adminHead('Messages', 'messages');
?>

<div class="page-header">
  <div>
    <h2 class="page-title">Messages</h2>
    <p class="page-sub">Contact form submissions from your public site. <?= $unread ? "<span class='pill pill-orange'>$unread unread</span>" : '' ?></p>
  </div>
</div>

<?php if ($viewing): ?>
<!-- Message Detail View -->
<div class="message-detail-back">
  <a href="/Hexspire_Solution/admin/messages.php" class="btn-back">← Back to Inbox</a>
</div>
<div class="message-detail">
  <div class="message-detail-header">
    <div class="message-detail-meta">
      <div class="message-avatar"><?= strtoupper(substr($viewing['name'],0,1)) ?></div>
      <div>
        <strong><?= htmlspecialchars($viewing['name']) ?></strong>
        <span><?= htmlspecialchars($viewing['email']) ?></span>
      </div>
    </div>
    <span class="message-date"><?= date('D, M j Y · g:ia', strtotime($viewing['created_at'])) ?></span>
  </div>
  <h3 class="message-subject"><?= htmlspecialchars($viewing['subject']) ?></h3>
  <div class="message-body"><?= nl2br(htmlspecialchars($viewing['message'])) ?></div>
  <div class="message-detail-actions">
    <a href="mailto:<?= htmlspecialchars($viewing['email']) ?>" class="btn-primary">Reply via Email</a>
    <form method="POST" onsubmit="return confirm('Delete this message?')">
      <input type="hidden" name="action" value="delete">
      <input type="hidden" name="id" value="<?= $viewing['id'] ?>">
      <button type="submit" class="btn-delete">Delete Message</button>
    </form>
  </div>
</div>

<?php else: ?>
<!-- Message List -->
<?php if (empty($messages)): ?>
<div class="empty-state">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="48" height="48"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
  <p>Your inbox is empty. Messages submitted via the contact form will appear here.</p>
</div>
<?php else: ?>
<div class="messages-list">
  <?php foreach ($messages as $m): ?>
  <div class="message-row <?= $m['is_read'] ? '' : 'message-unread' ?>" onclick="window.location='/Hexspire_Solution/admin/messages.php?view=<?= $m['id'] ?>'" style="cursor:pointer" id="msg-<?= $m['id'] ?>">
    <div class="message-row-avatar"><?= strtoupper(substr($m['name'],0,1)) ?></div>
    <div class="message-row-body">
      <div class="message-row-top">
        <span class="message-row-name"><?= htmlspecialchars($m['name']) ?></span>
        <span class="message-row-date"><?= date('M j, g:ia', strtotime($m['created_at'])) ?></span>
      </div>
      <div class="message-row-subject"><?= htmlspecialchars($m['subject']) ?></div>
      <div class="message-row-preview"><?= htmlspecialchars(mb_substr($m['message'], 0, 100)) ?>…</div>
    </div>
    <div class="message-row-actions" onclick="event.stopPropagation()">
      <?php if (!$m['is_read']): ?>
      <a href="/Hexspire_Solution/admin/messages.php?read=<?= $m['id'] ?>" class="btn-sm" title="Mark as read">✓ Read</a>
      <?php endif; ?>
      <form method="POST" onsubmit="return confirm('Delete?')">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="id" value="<?= $m['id'] ?>">
        <button type="submit" class="btn-delete-sm" id="del-msg-<?= $m['id'] ?>">✕</button>
      </form>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php endif; ?>
<?php endif; ?>

<?php adminFoot(); ?>

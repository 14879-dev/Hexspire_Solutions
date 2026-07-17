<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/header.php';

$db = getDB();
$msg = ''; $msgType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action   = $_POST['action'] ?? '';
    $id       = (int)($_POST['id'] ?? 0);
    $question = trim($_POST['question'] ?? '');
    $answer   = trim($_POST['answer'] ?? '');
    $order    = (int)($_POST['sort_order'] ?? 0);

    if ($action === 'add') {
        if ($question && $answer) {
            $stmt = $db->prepare("INSERT INTO hs_faqs (question, answer, sort_order) VALUES (?,?,?)");
            $stmt->execute([$question, $answer, $order]);
            $msg = 'FAQ added.'; $msgType = 'success';
        } else { $msg = 'Question and answer are required.'; $msgType = 'error'; }

    } elseif ($action === 'edit') {
        if ($question && $answer) {
            $stmt = $db->prepare("UPDATE hs_faqs SET question=?, answer=?, sort_order=? WHERE id=?");
            $stmt->execute([$question, $answer, $order, $id]);
            $msg = 'FAQ updated.'; $msgType = 'success';
        } else { $msg = 'Question and answer are required.'; $msgType = 'error'; }

    } elseif ($action === 'delete') {
        $db->prepare("DELETE FROM hs_faqs WHERE id=?")->execute([$id]);
        $msg = 'FAQ deleted.'; $msgType = 'success';
    }
}

$faqs = $db->query("SELECT * FROM hs_faqs ORDER BY sort_order ASC, id ASC")->fetchAll();

adminHead('FAQs', 'faqs');
?>

<div class="page-header">
  <div>
    <h2 class="page-title">FAQs</h2>
    <p class="page-sub">Manage the frequently asked questions shown on the public site.</p>
  </div>
  <button class="btn-primary" onclick="showModal('add-modal')" id="add-faq-btn">+ Add FAQ</button>
</div>

<?php if ($msg): ?>
<div class="alert alert-<?= $msgType ?>"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<div class="table-wrap">
  <table class="admin-table">
    <thead>
      <tr><th>#</th><th>Question</th><th>Answer</th><th>Order</th><th>Actions</th></tr>
    </thead>
    <tbody>
      <?php if (empty($faqs)): ?>
      <tr><td colspan="5" class="empty-cell">No FAQs yet. Add your first one!</td></tr>
      <?php else: ?>
      <?php foreach ($faqs as $i => $faq): ?>
      <tr>
        <td><?= $i+1 ?></td>
        <td><strong><?= htmlspecialchars($faq['question']) ?></strong></td>
        <td class="td-ellipsis"><?= htmlspecialchars($faq['answer']) ?></td>
        <td><?= $faq['sort_order'] ?></td>
        <td class="td-actions">
          <button class="btn-edit" onclick="editFaq(<?= htmlspecialchars(json_encode($faq)) ?>)" id="edit-faq-<?= $faq['id'] ?>">Edit</button>
          <form method="POST" style="display:inline" onsubmit="return confirm('Delete this FAQ?')">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?= $faq['id'] ?>">
            <button type="submit" class="btn-delete" id="del-faq-<?= $faq['id'] ?>">Delete</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- Add Modal -->
<div class="modal-overlay" id="add-modal" role="dialog" aria-modal="true">
  <div class="modal">
    <div class="modal-header">
      <h3>Add FAQ</h3>
      <button class="modal-close" onclick="hideModal('add-modal')" aria-label="Close">✕</button>
    </div>
    <form method="POST">
      <input type="hidden" name="action" value="add">
      <div class="form-group">
        <label for="add-question">Question *</label>
        <input type="text" name="question" id="add-question" required placeholder="e.g. How long does a project take?">
      </div>
      <div class="form-group">
        <label for="add-answer">Answer *</label>
        <textarea name="answer" id="add-answer" rows="4" required placeholder="Write the answer here…"></textarea>
      </div>
      <div class="form-group">
        <label for="add-order">Sort Order</label>
        <input type="number" name="sort_order" id="add-order" value="0" min="0">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-cancel" onclick="hideModal('add-modal')">Cancel</button>
        <button type="submit" class="btn-primary" id="add-faq-submit">Add FAQ</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal-overlay" id="edit-modal" role="dialog" aria-modal="true">
  <div class="modal">
    <div class="modal-header">
      <h3>Edit FAQ</h3>
      <button class="modal-close" onclick="hideModal('edit-modal')" aria-label="Close">✕</button>
    </div>
    <form method="POST">
      <input type="hidden" name="action" value="edit">
      <input type="hidden" name="id" id="edit-id">
      <div class="form-group">
        <label for="edit-question">Question *</label>
        <input type="text" name="question" id="edit-question" required>
      </div>
      <div class="form-group">
        <label for="edit-answer">Answer *</label>
        <textarea name="answer" id="edit-answer" rows="4" required></textarea>
      </div>
      <div class="form-group">
        <label for="edit-order">Sort Order</label>
        <input type="number" name="sort_order" id="edit-order" min="0">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-cancel" onclick="hideModal('edit-modal')">Cancel</button>
        <button type="submit" class="btn-primary" id="edit-faq-submit">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<script>
function editFaq(data) {
  document.getElementById('edit-id').value       = data.id;
  document.getElementById('edit-question').value = data.question;
  document.getElementById('edit-answer').value   = data.answer;
  document.getElementById('edit-order').value    = data.sort_order;
  showModal('edit-modal');
}
</script>

<?php adminFoot(); ?>

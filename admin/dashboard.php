<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/header.php';

$db = getDB();

$totalServices = $db->query("SELECT COUNT(*) FROM hs_services")->fetchColumn();
$totalProjects = $db->query("SELECT COUNT(*) FROM hs_projects")->fetchColumn();
$totalTeam     = $db->query("SELECT COUNT(*) FROM hs_team")->fetchColumn();
$totalMessages = $db->query("SELECT COUNT(*) FROM hs_messages")->fetchColumn();
$unreadMessages= $db->query("SELECT COUNT(*) FROM hs_messages WHERE is_read=0")->fetchColumn();

$recentMessages = $db->query("SELECT * FROM hs_messages ORDER BY created_at DESC LIMIT 5")->fetchAll();

adminHead('Dashboard', 'dashboard');
?>

<div class="page-header">
  <div>
    <h2 class="page-title">Dashboard</h2>
    <p class="page-sub">Welcome back! Here's what's happening on your site.</p>
  </div>
</div>

<!-- Stats Cards -->
<div class="stat-cards">
  <div class="stat-card">
    <div class="stat-card-icon orange">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value"><?= $totalServices ?></div>
      <div class="stat-card-label">Services</div>
    </div>
    <a href="/Hexspire_Solution/admin/services.php" class="stat-card-link">Manage →</a>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon blue">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value"><?= $totalProjects ?></div>
      <div class="stat-card-label">Projects</div>
    </div>
    <a href="/Hexspire_Solution/admin/projects.php" class="stat-card-link">Manage →</a>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon green">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value"><?= $totalTeam ?></div>
      <div class="stat-card-label">Team Members</div>
    </div>
    <a href="/Hexspire_Solution/admin/team.php" class="stat-card-link">Manage →</a>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon <?= $unreadMessages > 0 ? 'red' : 'gray' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value"><?= $totalMessages ?></div>
      <div class="stat-card-label">Messages <?= $unreadMessages > 0 ? "<span class='badge badge-sm'>$unreadMessages new</span>" : '' ?></div>
    </div>
    <a href="/Hexspire_Solution/admin/messages.php" class="stat-card-link">View →</a>
  </div>
</div>

<!-- Recent Messages -->
<div class="admin-section">
  <div class="section-head">
    <h3>Recent Messages</h3>
    <a href="/Hexspire_Solution/admin/messages.php" class="btn-sm">View All</a>
  </div>
  <?php if (empty($recentMessages)): ?>
    <div class="empty-state">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="40" height="40"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
      <p>No messages yet.</p>
    </div>
  <?php else: ?>
    <div class="table-wrap">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($recentMessages as $msg): ?>
          <tr class="<?= $msg['is_read'] ? '' : 'row-unread' ?>" onclick="window.location='/Hexspire_Solution/admin/messages.php?view=<?= $msg['id'] ?>'" style="cursor:pointer">
            <td><?= htmlspecialchars($msg['name']) ?></td>
            <td><?= htmlspecialchars($msg['email']) ?></td>
            <td><?= htmlspecialchars($msg['subject']) ?></td>
            <td><?= date('M j, Y', strtotime($msg['created_at'])) ?></td>
            <td><?= $msg['is_read'] ? '<span class="pill pill-gray">Read</span>' : '<span class="pill pill-orange">New</span>' ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<?php adminFoot(); ?>

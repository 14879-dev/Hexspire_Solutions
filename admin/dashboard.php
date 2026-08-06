<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/header.php';

$db = getDB();

$totalServices  = $db->query("SELECT COUNT(*) FROM hs_services")->fetchColumn();
$totalProjects  = $db->query("SELECT COUNT(*) FROM hs_projects")->fetchColumn();
$totalTeam      = $db->query("SELECT COUNT(*) FROM hs_team")->fetchColumn();
$totalMessages  = $db->query("SELECT COUNT(*) FROM hs_messages")->fetchColumn();
$unreadMessages = $db->query("SELECT COUNT(*) FROM hs_messages WHERE is_read=0")->fetchColumn();

$recentMessages = $db->query("SELECT * FROM hs_messages ORDER BY created_at DESC LIMIT 5")->fetchAll();

// Visitor stats — safe fallback if table not created yet
$uniqueVisitors = 0;
$totalPageViews = 0;
$todayVisitors  = 0;
$weeklyLabels   = [];
$weeklyData     = [];

try {
    $uniqueVisitors = $db->query("SELECT COUNT(*) FROM hs_visitors")->fetchColumn();
    $totalPageViews = $db->query("SELECT SUM(visits) FROM hs_visitors")->fetchColumn() ?: 0;
    $todayVisitors  = $db->query("SELECT COUNT(*) FROM hs_visitors WHERE DATE(last_visit) = CURDATE()")->fetchColumn();

    // Last 7 days trend
    $trend = $db->query("
        SELECT DATE(last_visit) as day, COUNT(*) as cnt
        FROM hs_visitors
        WHERE last_visit >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
        GROUP BY DATE(last_visit)
        ORDER BY day ASC
    ")->fetchAll(\PDO::FETCH_KEY_PAIR);

    for ($i = 6; $i >= 0; $i--) {
        $d = date('Y-m-d', strtotime("-$i days"));
        $weeklyLabels[] = date('D d', strtotime($d));
        $weeklyData[]   = $trend[$d] ?? 0;
    }
} catch (\Exception $e) {
    // Table not yet created — show zeros
}

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
    <a href="services.php" class="stat-card-link">Manage →</a>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon blue">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value"><?= $totalProjects ?></div>
      <div class="stat-card-label">Projects</div>
    </div>
    <a href="projects.php" class="stat-card-link">Manage →</a>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon green">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value"><?= $totalTeam ?></div>
      <div class="stat-card-label">Team Members</div>
    </div>
    <a href="team.php" class="stat-card-link">Manage →</a>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon <?= $unreadMessages > 0 ? 'red' : 'gray' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value"><?= $totalMessages ?></div>
      <div class="stat-card-label">Messages <?= $unreadMessages > 0 ? "<span class='badge badge-sm'>$unreadMessages new</span>" : '' ?></div>
    </div>
    <a href="messages.php" class="stat-card-link">View →</a>
  </div>
</div>

<!-- Visitor Stats -->
<div class="stat-cards" style="margin-top:16px;">
  <div class="stat-card">
    <div class="stat-card-icon" style="background:rgba(99,102,241,0.12);color:#6366f1;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value"><?= number_format($uniqueVisitors) ?></div>
      <div class="stat-card-label">Unique Visitors</div>
    </div>
    <span class="stat-card-link" style="cursor:default;opacity:.5;">All time</span>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon" style="background:rgba(20,184,166,0.12);color:#14b8a6;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value"><?= number_format($totalPageViews) ?></div>
      <div class="stat-card-label">Total Page Views</div>
    </div>
    <span class="stat-card-link" style="cursor:default;opacity:.5;">All time</span>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon" style="background:rgba(251,146,60,0.12);color:#fb923c;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value"><?= number_format($todayVisitors) ?></div>
      <div class="stat-card-label">Today's Visitors</div>
    </div>
    <span class="stat-card-link" style="cursor:default;opacity:.5;">Last 24h</span>
  </div>
</div>

<!-- 7-Day Visitors Chart -->
<?php if (!empty($weeklyData)): ?>
<div class="admin-section" style="margin-top:24px;">
  <div class="section-head">
    <h3>Visitor Trend — Last 7 Days</h3>
  </div>
  <div style="position:relative;height:220px;padding:16px 0;">
    <canvas id="visitorsChart"></canvas>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
  <script>
  (function() {
    const ctx = document.getElementById('visitorsChart');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?= json_encode($weeklyLabels) ?>,
        datasets: [{
          label: 'Unique Visitors',
          data: <?= json_encode($weeklyData) ?>,
          backgroundColor: 'rgba(99,102,241,0.2)',
          borderColor: '#6366f1',
          borderWidth: 2,
          borderRadius: 6,
          borderSkipped: false,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          y: {
            beginAtZero: true,
            ticks: { stepSize: 1, color: '#64748b' },
            grid: { color: 'rgba(0,0,0,0.05)' }
          },
          x: {
            ticks: { color: '#64748b' },
            grid: { display: false }
          }
        }
      }
    });
  })();
  </script>
</div>
<?php endif; ?>


<!-- Recent Messages -->
<div class="admin-section">
  <div class="section-head">
    <h3>Recent Messages</h3>
    <a href="messages.php" class="btn-sm">View All</a>
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
          <tr class="<?= $msg['is_read'] ? '' : 'row-unread' ?>" onclick="window.location='messages.php?view=<?= $msg['id'] ?>'" style="cursor:pointer">
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

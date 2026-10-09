<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/header.php';

$db = getDB();

// Counts
$totalServices  = (int)$db->query("SELECT COUNT(*) FROM hs_services")->fetchColumn();
$totalProjects  = (int)$db->query("SELECT COUNT(*) FROM hs_projects")->fetchColumn();
$totalTeam      = (int)$db->query("SELECT COUNT(*) FROM hs_team")->fetchColumn();
$totalMessages  = (int)$db->query("SELECT COUNT(*) FROM hs_messages")->fetchColumn();
$unreadMessages = (int)$db->query("SELECT COUNT(*) FROM hs_messages WHERE is_read=0")->fetchColumn();

// Additional counts if tables exist
$totalBlogPosts     = 0;
$publishedBlogPosts = 0;
$totalPages         = 0;
$totalFaqs          = 0;

try {
    $totalBlogPosts     = (int)$db->query("SELECT COUNT(*) FROM hs_blog_posts")->fetchColumn();
    $publishedBlogPosts = (int)$db->query("SELECT COUNT(*) FROM hs_blog_posts WHERE is_published=1")->fetchColumn();
} catch (\Throwable $e) {}

try {
    $totalPages = (int)$db->query("SELECT COUNT(*) FROM hs_pages")->fetchColumn();
} catch (\Throwable $e) {}

try {
    $totalFaqs = (int)$db->query("SELECT COUNT(*) FROM hs_faqs")->fetchColumn();
} catch (\Throwable $e) {}

// Recent data
$recentMessages = $db->query("SELECT * FROM hs_messages ORDER BY created_at DESC LIMIT 5")->fetchAll();
$recentProjects = $db->query("SELECT * FROM hs_projects ORDER BY id DESC LIMIT 5")->fetchAll();
$recentBlog     = [];
try {
    $recentBlog = $db->query("SELECT id, title, slug, is_published, created_at FROM hs_blog_posts ORDER BY created_at DESC LIMIT 5")->fetchAll();
} catch (\Throwable $e) {}

// Visitor stats
$uniqueVisitors = 0;
$totalPageViews = 0;
$todayVisitors  = 0;
$weeklyLabels   = [];
$weeklyData     = [];

try {
    $uniqueVisitors = (int)$db->query("SELECT COUNT(*) FROM hs_visitors")->fetchColumn();
    $totalPageViews = (int)$db->query("SELECT SUM(visits) FROM hs_visitors")->fetchColumn() ?: 0;
    $todayVisitors  = (int)$db->query("SELECT COUNT(*) FROM hs_visitors WHERE DATE(last_visit) = CURDATE()")->fetchColumn();

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
        $weeklyData[]   = (int)($trend[$d] ?? 0);
    }
} catch (\Throwable $e) {
    // Table not created yet
}

// System diagnostics
$phpVersion    = PHP_VERSION;
$isUploadsOk   = is_writable(__DIR__ . '/../uploads');
$isHttps       = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
$serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? 'Web Server';

adminHead('Detailed Dashboard', 'dashboard');
?>

<div class="page-header" style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:16px;">
  <div>
    <h2 class="page-title">Operational Command Center</h2>
    <p class="page-sub">Welcome back! Real-time metrics, content status, and site diagnostics for Hexspire Solutions.</p>
  </div>
  <div style="display:flex;gap:10px;flex-wrap:wrap;">
    <a href="projects.php" class="btn btn-primary" style="display:inline-flex;align-items:center;gap:6px;font-size:0.875rem;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      Add Project
    </a>
    <a href="blog.php" class="btn btn-secondary" style="display:inline-flex;align-items:center;gap:6px;font-size:0.875rem;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      New Article
    </a>
    <a href="../index.php" target="_blank" class="btn btn-secondary" style="display:inline-flex;align-items:center;gap:6px;font-size:0.875rem;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
      Live Site
    </a>
  </div>
</div>

<!-- Primary Stats Grid -->
<div class="stat-cards" style="grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:16px;">
  
  <!-- Services -->
  <div class="stat-card">
    <div class="stat-card-icon orange">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value"><?= $totalServices ?></div>
      <div class="stat-card-label">Services Active</div>
    </div>
    <a href="services.php" class="stat-card-link">Manage &rarr;</a>
  </div>

  <!-- Projects -->
  <div class="stat-card">
    <div class="stat-card-icon blue">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value"><?= $totalProjects ?></div>
      <div class="stat-card-label">Portfolio Projects</div>
    </div>
    <a href="projects.php" class="stat-card-link">Manage &rarr;</a>
  </div>

  <!-- Blog Posts -->
  <div class="stat-card">
    <div class="stat-card-icon" style="background:rgba(168,85,247,0.12);color:#a855f7;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value"><?= $totalBlogPosts ?></div>
      <div class="stat-card-label">Articles (<?= $publishedBlogPosts ?> live)</div>
    </div>
    <a href="blog.php" class="stat-card-link">Manage &rarr;</a>
  </div>

  <!-- Team -->
  <div class="stat-card">
    <div class="stat-card-icon green">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value"><?= $totalTeam ?></div>
      <div class="stat-card-label">Team Members</div>
    </div>
    <a href="team.php" class="stat-card-link">Manage &rarr;</a>
  </div>

  <!-- Inquiries -->
  <div class="stat-card">
    <div class="stat-card-icon <?= $unreadMessages > 0 ? 'red' : 'gray' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value"><?= $totalMessages ?></div>
      <div class="stat-card-label">Client Inquiries <?= $unreadMessages > 0 ? "<span class='badge badge-sm' style='background:#ef4444;color:#fff;'>$unreadMessages new</span>" : '' ?></div>
    </div>
    <a href="messages.php" class="stat-card-link">Inbox &rarr;</a>
  </div>

</div>

<!-- Traffic Analytics & Trend Chart -->
<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px;margin-top:20px;">
  
  <div class="admin-section" style="margin:0;">
    <div class="section-head">
      <div>
        <h3 style="margin:0;">Visitor Analytics (Last 7 Days)</h3>
        <span style="font-size:0.8rem;color:#64748b;">Daily unique IP addresses logged by telemetry tracker</span>
      </div>
      <span class="pill pill-orange" style="font-size:0.75rem;">Live Telemetry</span>
    </div>

    <div style="position:relative;height:240px;padding:12px 0;">
      <canvas id="visitorsChart"></canvas>
    </div>
  </div>

  <!-- Quick Traffic & Health Cards -->
  <div style="display:flex;flex-direction:column;gap:16px;">
    
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:20px;">
      <div style="font-size:0.8rem;font-weight:700;text-transform:uppercase;color:#64748b;letter-spacing:0.05em;margin-bottom:12px;">Audience Overview</div>
      <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #f1f5f9;">
        <span style="color:#475569;font-size:0.875rem;">Unique Visitors</span>
        <strong style="font-size:1.1rem;color:#0f172a;"><?= number_format($uniqueVisitors) ?></strong>
      </div>
      <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #f1f5f9;">
        <span style="color:#475569;font-size:0.875rem;">Total Page Views</span>
        <strong style="font-size:1.1rem;color:#0f172a;"><?= number_format($totalPageViews) ?></strong>
      </div>
      <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;">
        <span style="color:#475569;font-size:0.875rem;">Today's Sessions</span>
        <span class="pill pill-orange" style="font-weight:700;"><?= number_format($todayVisitors) ?> today</span>
      </div>
    </div>

    <!-- Server & Environment Diagnostics -->
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:20px;">
      <div style="font-size:0.8rem;font-weight:700;text-transform:uppercase;color:#64748b;letter-spacing:0.05em;margin-bottom:12px;">System Diagnostics</div>
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;font-size:0.85rem;">
        <span style="color:#475569;">PHP Engine</span>
        <span class="pill pill-gray" style="font-family:monospace;"><?= htmlspecialchars($phpVersion) ?></span>
      </div>
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;font-size:0.85rem;">
        <span style="color:#475569;">Uploads Directory</span>
        <span class="pill <?= $isUploadsOk ? 'pill-green' : 'pill-red' ?>"><?= $isUploadsOk ? 'Writable' : 'Locked' ?></span>
      </div>
      <div style="display:flex;justify-content:space-between;align-items:center;font-size:0.85rem;">
        <span style="color:#475569;">Database</span>
        <span class="pill pill-green">Connected (PDO)</span>
      </div>
    </div>

  </div>

</div>

<!-- Split Tables Section: Recent Inquiries & Recent Projects -->
<div style="display:grid;grid-template-columns:1.2fr 1fr;gap:20px;margin-top:24px;">

  <!-- Recent Messages Table -->
  <div class="admin-section" style="margin:0;">
    <div class="section-head">
      <h3 style="margin:0;">Recent Inquiries</h3>
      <a href="messages.php" class="btn-sm">View All &rarr;</a>
    </div>
    <?php if (empty($recentMessages)): ?>
      <div class="empty-state" style="padding:32px 0;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="36" height="36" style="color:#94a3b8;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        <p style="margin:8px 0 0;font-size:0.9rem;color:#64748b;">No contact submissions logged yet.</p>
      </div>
    <?php else: ?>
      <div class="table-wrap">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Sender</th>
              <th>Subject</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($recentMessages as $msg): ?>
            <tr class="<?= $msg['is_read'] ? '' : 'row-unread' ?>" onclick="window.location='messages.php?view=<?= $msg['id'] ?>'" style="cursor:pointer">
              <td>
                <strong style="display:block;color:#0f172a;"><?= htmlspecialchars($msg['name']) ?></strong>
                <span style="font-size:0.78rem;color:#64748b;"><?= htmlspecialchars($msg['email']) ?></span>
              </td>
              <td><?= htmlspecialchars(mb_strimwidth($msg['subject'] ?? '', 0, 32, '...')) ?></td>
              <td style="font-size:0.8rem;white-space:nowrap;"><?= date('M j, Y', strtotime($msg['created_at'])) ?></td>
              <td><?= $msg['is_read'] ? '<span class="pill pill-gray">Read</span>' : '<span class="pill pill-orange">New</span>' ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>

  <!-- Recent Projects Preview -->
  <div class="admin-section" style="margin:0;">
    <div class="section-head">
      <h3 style="margin:0;">Recent Projects</h3>
      <a href="projects.php" class="btn-sm">Manage &rarr;</a>
    </div>
    <?php if (empty($recentProjects)): ?>
      <div class="empty-state" style="padding:32px 0;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="36" height="36" style="color:#94a3b8;"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        <p style="margin:8px 0 0;font-size:0.9rem;color:#64748b;">No projects added yet.</p>
      </div>
    <?php else: ?>
      <div class="table-wrap">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Project Title</th>
              <th>Category</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($recentProjects as $proj): ?>
            <tr>
              <td>
                <strong style="color:#0f172a;"><?= htmlspecialchars($proj['title']) ?></strong>
              </td>
              <td>
                <span class="pill pill-gray" style="font-size:0.75rem;"><?= htmlspecialchars($proj['category'] ?? 'General') ?></span>
              </td>
              <td>
                <a href="projects.php?edit=<?= $proj['id'] ?>" class="btn-sm" style="font-size:0.75rem;padding:4px 8px;">Edit</a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>

</div>

<!-- Chart Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
<script>
(function() {
  const ctx = document.getElementById('visitorsChart');
  if (!ctx) return;
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode($weeklyLabels) ?>,
      datasets: [{
        label: 'Unique Visitors',
        data: <?= json_encode($weeklyData) ?>,
        backgroundColor: 'rgba(13,110,253,0.18)',
        borderColor: '#0d6efd',
        borderWidth: 2,
        borderRadius: 6,
        borderSkipped: false,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: '#0f172a',
          titleFont: { size: 12 },
          bodyFont: { size: 12 },
          padding: 10,
          cornerRadius: 6
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: { stepSize: 1, color: '#64748b', font: { size: 11 } },
          grid: { color: 'rgba(0,0,0,0.04)' }
        },
        x: {
          ticks: { color: '#64748b', font: { size: 11 } },
          grid: { display: false }
        }
      }
    }
  });
})();
</script>

<?php adminFoot(); ?>

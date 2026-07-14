<?php
session_start();

require_once __DIR__ . '/../includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username && $password) {
        try {
            $db = getDB();
            $stmtU = $db->prepare("SELECT value FROM hs_settings WHERE `key` = 'admin_username'");
            $stmtU->execute();
            $storedUser = $stmtU->fetchColumn();

            $stmtP = $db->prepare("SELECT value FROM hs_settings WHERE `key` = 'admin_password_hash'");
            $stmtP->execute();
            $storedHash = $stmtP->fetchColumn();

            if ($username === $storedUser && password_verify($password, $storedHash)) {
                $_SESSION['hs_admin'] = true;
                $_SESSION['hs_admin_user'] = $username;
                header('Location: dashboard.php');
                exit;
            } else {
                $error = 'Invalid username or password.';
            }
        } catch (Throwable $e) {
            $error = 'Database error. Please run setup.php first.';
        }
    } else {
        $error = 'Please enter both username and password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — Hexspire Solutions</title>
  <meta name="robots" content="noindex, nofollow">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="login-page">

<div class="login-wrap">
  <div class="login-card">
    <div class="login-brand">
      <div class="login-logo">H</div>
      <h1 class="login-title">Hexspire Admin</h1>
      <p class="login-sub">Sign in to manage your website</p>
    </div>

    <?php if ($error): ?>
    <div class="alert alert-error" role="alert"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="" id="login-form" novalidate>
      <div class="form-group">
        <label for="username">Username</label>
        <div class="input-wrap">
          <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          <input type="text" id="username" name="username" placeholder="admin" required autocomplete="username"
                 value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <div class="input-wrap">
          <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
        </div>
      </div>
      <button type="submit" class="login-btn" id="login-submit">Sign In</button>
    </form>

    <p class="login-note">Not a public page — admin access only.</p>
  </div>
</div>

<script src="../assets/js/admin.js"></script>
</body>
</html>

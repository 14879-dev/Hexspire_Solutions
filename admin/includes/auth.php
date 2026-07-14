<?php
/**
 * Admin Auth Guard — include at top of every protected admin page
 */
session_start();
if (empty($_SESSION['hs_admin'])) {
    header('Location: login.php');
    exit;
}

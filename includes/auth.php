<?php
// session start & keep session on
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

function isLoggedIn() {
  return isset($_SESSION['user_id']);
}

function getUserRole() {
  if (isLoggedIn()) {
    return $_SESSION['rol'] ?? null;
  }
  return null;
}


function checkRole($allowedRoles) {
  // login check
  if (!isLoggedIn()) {
    header('Location: index.php?action=login');
    exit;
  }

  // get user role
  $userRole = getUserRole();

  // role check from DB(enum)
  if (!in_array($userRole, $allowedRoles)) {
    // if error -> al inicio
    header('Location: index.php?action=login&error=unauthorized');
    exit;
  }
}

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


// // 다른 PHP 파일 맨 위에서 이렇게 사용
// require_once __DIR__ . '/includes/auth.php';

// // 로그인 확인
// if (isLoggedIn()) {
//     echo "로그인됨!";
// } else {
//     echo "로그인 안 됨!";
// }

// // 역할 확인
// $role = getUserRole();
// if ($role === 'coach') {
//     echo "코치님 환영합니다!";
// }

// 함수 3: 권한 확인 함수
// 사용법: checkRole(['coach', 'admin']);
// 설명: 현재 사용자가 허용된 역할 중 하나인지 확인
//       권한이 없으면 자동으로 로그인 페이지로 이동



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

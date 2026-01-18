<?php

// # Hostinger server #
// $host = "localhost";
// $dbname = "u443289048_natacion_club";
// $user = "u443289048_natabase";
// $password = "B3hLh#u8";
// $charset = "utf8mb4";

$host = "localhost:10011"; // *LOCAL 포트확인
$dbname = "natacion_club";
$user = "root";
$password = "root";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false,
];

try {
  $pdo = new PDO($dsn, $user, $password, $options);
  // echo "연결 성공";
  $pdo = null;
  // echo "연결 해제";
} catch (\PDOException $e) {
  throw new \PDOException($e->getMessage());
}

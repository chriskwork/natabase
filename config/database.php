<?php

// $host = "localhost";
// $dbname = "u443289048_natacion_club";
// $user = "u443289048_natabase";
// $password = "B3hLh#u8";
// $charset = "utf8mb4";

$host = "localhost";
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
  echo "연결 성공";
} catch (\PDOException $e) {
  throw new \PDOException($e->getMessage());
}

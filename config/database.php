<?php

$host = "localhost";
$port = "10010"; // *LOCAL 포트확인
$dbname = "natacion_club";
$user = "root";
$password = "root";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";

$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false,
];

try {
  $pdo = new PDO($dsn, $user, $password, $options);
} catch (\PDOException $e) {
  throw new \PDOException($e->getMessage());
}

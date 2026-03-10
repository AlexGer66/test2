<?php
$dsn = 'mysql:host=db;dbname=todo;charset=utf8';
$user = 'user';
$pass = 'password';

try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    echo "DB Connection failed: " . $e->getMessage();
    exit;
}

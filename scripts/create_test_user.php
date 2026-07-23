<?php
// Creates a test user directly via PDO to avoid seeder issues.
$dbHost = '127.0.0.1';
$dbName = 'laravel';
$dbUser = 'root';
$dbPass = '';
$email = 'tester@example.com';
$passwordPlain = 'Test1234';
$name = 'Tester';

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // check if user exists
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $exists = $stmt->fetchColumn();
    if ($exists) {
        echo "User already exists with id: $exists\n";
        exit(0);
    }

    $hash = password_hash($passwordPlain, PASSWORD_BCRYPT);
    $now = date('Y-m-d H:i:s');

    $insert = $pdo->prepare('INSERT INTO users (name, email, password, created_at, updated_at) VALUES (?, ?, ?, ?, ?)');
    $insert->execute([$name, $email, $hash, $now, $now]);

    echo "Created user $email with password $passwordPlain\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}

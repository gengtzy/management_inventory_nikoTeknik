<?php

// Suppress raw display errors and deprecation warnings in response output
ini_set('display_errors', '0');
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

// Ensure HTTPS is recognized behind Vercel reverse proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = '443';
}

// Forward Vercel requests to Laravel
$storageDir = '/tmp/storage';
$dirs = [
    $storageDir . '/framework/views',
    $storageDir . '/framework/cache/data',
    $storageDir . '/framework/sessions',
    $storageDir . '/logs',
    $storageDir . '/app',
    '/tmp/bootstrap/cache',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Ensure Laravel uses the writable /tmp storage path
putenv("APP_STORAGE_PATH={$storageDir}");
$_ENV['APP_STORAGE_PATH'] = $storageDir;

// Handle SQLite on Vercel: copy bundled pre-seeded sqlite database to writable /tmp
$connection = getenv('DB_CONNECTION') ?: ($_ENV['DB_CONNECTION'] ?? 'sqlite');
if ($connection === 'sqlite') {
    $targetDb = '/tmp/database.sqlite';
    $sourceDb = __DIR__ . '/../database/database.sqlite';

    if (!file_exists($targetDb) && file_exists($sourceDb)) {
        @copy($sourceDb, $targetDb);
    } elseif (!file_exists($targetDb)) {
        @touch($targetDb);
    }

    putenv("DB_DATABASE={$targetDb}");
    $_ENV['DB_DATABASE'] = $targetDb;
}

// Forward to public/index.php
require __DIR__ . '/../public/index.php';

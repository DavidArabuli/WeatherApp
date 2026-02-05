<?php
$envFile = __DIR__ . '/.env';

if (getenv('APP_ENV') === 'docker') {
    $envFile = __DIR__ . '/.env.docker';
}

if (file_exists($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (str_starts_with($line, '#')) continue;
        putenv($line);
    }
}

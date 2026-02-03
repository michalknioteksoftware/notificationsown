<?php

// Helper script to safely run Laravel artisan commands during composer install
// This prevents errors when Laravel is not fully configured yet

if (!file_exists('.env')) {
    // .env doesn't exist, skip
    exit(0);
}

$envContent = file_get_contents('.env');
if (empty(trim($envContent))) {
    // .env is empty, skip
    exit(0);
}

// Check if APP_KEY is set and has a proper value
if (preg_match('/^APP_KEY=(.+)$/m', $envContent, $matches)) {
    $appKey = trim($matches[1]);
    // APP_KEY should be "base64:..." which is longer than 10 chars
    if (strlen($appKey) > 10 && (strpos($appKey, 'base64:') === 0 || strlen($appKey) > 20)) {
        // Laravel should be able to bootstrap, try running the command
        $command = isset($argv[1]) ? $argv[1] : 'package:discover --ansi';
        $fullCommand = "php artisan {$command}";
        passthru($fullCommand, $returnCode);
        exit($returnCode);
    }
}

// If we get here, Laravel is not ready yet, just exit successfully
exit(0);

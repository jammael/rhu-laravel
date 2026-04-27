<?php

// Force Laravel to use the temporary folder for EVERYTHING
putenv('VIEW_COMPILED_PATH=/tmp');
putenv('SESSION_DRIVER=cookie');
putenv('LOG_CHANNEL=stderr');
putenv('APP_SERVICES_CACHE=/tmp/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/packages.php');
putenv('APP_CONFIG_CACHE=/tmp/config.php');
putenv('APP_ROUTES_CACHE=/tmp/routes.php');
// require __DIR__ . '/../public/index.php';
// This file is the entry point for Vercel serverless functions
// It bridges incoming requests to the Laravel application

// Set environment to use Vercel's temporary directory
putenv('TMPDIR=/tmp');
putenv('TEMPDIR=/tmp');

// Get the Laravel public/index.php
$basePath = realpath(__DIR__ . '/../public/index.php');

if (!file_exists($basePath)) {
    http_response_code(500);
    echo 'Laravel public/index.php not found';
    exit(1);
}

// Include and execute the Laravel application
require $basePath;

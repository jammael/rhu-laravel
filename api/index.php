<?php

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

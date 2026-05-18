<?php

// Force Laravel to use writable serverless paths on Vercel.
putenv('VIEW_COMPILED_PATH=/tmp');
putenv('SESSION_DRIVER=cookie');
putenv('LOG_CHANNEL=stderr');
putenv('APP_SERVICES_CACHE=/tmp/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/packages.php');
putenv('APP_CONFIG_CACHE=/tmp/config.php');
putenv('APP_ROUTES_CACHE=/tmp/routes.php');
putenv('CACHE_STORE=array');
putenv('QUEUE_CONNECTION=sync');

putenv('TMPDIR=/tmp');
putenv('TEMPDIR=/tmp');

foreach ([
    '/tmp/storage',
    '/tmp/storage/framework',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
] as $directory) {
    if (! is_dir($directory)) {
        mkdir($directory, 0777, true);
    }
}

$basePath = realpath(__DIR__ . '/../public/index.php');

if (! file_exists($basePath)) {
    http_response_code(500);
    echo 'Laravel public/index.php not found';
    exit(1);
}

require $basePath;

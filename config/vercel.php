<?php

/**
 * Vercel Deployment Configuration
 *
 * This configuration file helps Laravel work correctly on Vercel's serverless platform.
 * Vercel's filesystem is ephemeral, so we configure Laravel to use the /tmp directory
 * which persists during the execution of a single serverless function invocation.
 */

return [
    // Use /tmp for storage (logs, files uploaded by users, etc.)
    'storage_path' => env('VERCEL_STORAGE_PATH', '/tmp/storage'),

    // Cache configuration for Vercel
    'cache' => [
        'driver' => env('CACHE_DRIVER', 'array'),
        'default' => env('CACHE_DRIVER', 'array'),
    ],

    // Session configuration for Vercel
    'session' => [
        'driver' => env('SESSION_DRIVER', 'cookie'),
    ],

    // Log configuration
    'log' => [
        'path' => env('LOG_PATH', '/tmp/storage/logs'),
    ],
];

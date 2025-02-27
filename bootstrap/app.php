<?php
// Autoload classes
require_once __DIR__ . '/autoload.php';

// Load environment variables
$dotenv = new Dotenv\Dotenv(APP_PATH);
$dotenv->load();

// Set error reporting based on environment
if ($_ENV['APP_ENV'] === 'development') {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}

// Initialize session
session_start();

// Load configuration files
$config = [
    'app' => require APP_PATH . 'config/app.php',
    'database' => require APP_PATH . 'config/database.php',
    'routes' => require APP_PATH . 'config/routes.php',
];

// Initialize the database connection
DatabaseHelper::initialize($config['database']);

// Load routes
require APP_PATH . 'routes/web.php';
require APP_PATH . 'routes/admin.php';
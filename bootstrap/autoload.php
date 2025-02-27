<?php
// Composer autoloader
if (file_exists(APP_PATH . 'vendor/autoload.php')) {
    require APP_PATH . 'vendor/autoload.php';
}

// Custom autoloader for app classes
spl_autoload_register(function ($class) {
    // Convert namespace separators to directory separators
    $class = str_replace('\\', '/', $class);
    
    // Define class directories to check
    $directories = [
        APP_PATH . 'app/controllers/',
        APP_PATH . 'app/models/entities/',
        APP_PATH . 'app/models/repositories/',
        APP_PATH . 'app/models/services/',
        APP_PATH . 'app/helpers/',
        APP_PATH . 'app/middleware/',
    ];
    
    // Check each directory for the class file
    foreach ($directories as $directory) {
        $file = $directory . $class . '.php';
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});
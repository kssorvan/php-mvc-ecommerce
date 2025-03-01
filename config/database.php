<?php \n// \config\database.php\n\n?>
<?php

// config/database.php
return [
    'host' => $_ENV['DB_HOST'] ?? 'localhost',
    'username' => $_ENV['DB_USERNAME'] ?? 'root',
    'password' => $_ENV['DB_PASSWORD'] ?? '',
    'database' => $_ENV['DB_DATABASE'] ?? 'ecommerce_shop',
    'charset' => 'utf8mb4'
];
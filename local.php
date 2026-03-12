<?php
// Router for PHP's built-in web server.
// Usage: php -S localhost:8000 router.php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = rtrim($path, '/');

if ($path === '' || $path === '/index.php') {
    include './index.php';
} elseif (preg_match('#^/projects/([^/]+)(?:/(page|drawing)/([^/]+))?$#', $path, $m)) {
    $_GET['project'] = $m[1];
    if (isset($m[2]) && $m[2] === 'page') {
        $_GET['page'] = $m[3];
    } elseif (isset($m[2]) && $m[2] === 'drawing') {
        $_GET['drawing'] = $m[3];
    }
    include './projects.php';
} elseif (file_exists(__DIR__ . $path) && !is_dir(__DIR__ . $path)) {
    return false; // Let the built-in server handle static files
} else {
    http_response_code(404);
    echo '<p>Not found.</p>';
}

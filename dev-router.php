<?php
/**
 * Local preview only:  php -S localhost:4180 dev-router.php
 *
 * Mirrors the .htaccess rules for PHP's built-in server — clean URLs,
 * .php → clean 301s, private folders and the 404 page. Apache never runs
 * this file: .htaccess denies it, and it refuses any other server.
 */
if (PHP_SAPI !== 'cli-server') {
    http_response_code(404);
    exit;
}

$uri  = (string) $_SERVER['REQUEST_URI'];
$path = rawurldecode((string) parse_url($uri, PHP_URL_PATH));
$qs   = (string) parse_url($uri, PHP_URL_QUERY);

// Private folders, dotfiles and path tricks stay out of reach, as on Apache.
if (str_contains($path, '..') || preg_match('#^/(includes|storage)(/|$)|/\.#', $path)) {
    http_response_code(403);
    exit;
}

// Old .php addresses redirect to the clean URL (never for form posts).
if (str_ends_with($path, '.php') && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    $clean = preg_replace('#(^|/)index\.php$|\.php$#', '$1', $path);
    header('Location: ' . $clean . ($qs !== '' ? '?' . $qs : ''), true, 301);
    exit;
}

// Static files are served as they are.
if ($path !== '/' && is_file(__DIR__ . $path)) {
    return false;
}

// Clean URL → page script, otherwise the 404 page.
$script = $path === '/' ? '/index.php' : rtrim($path, '/') . '.php';
if (!is_file(__DIR__ . $script)) {
    $script = '/404.php';
}
$_SERVER['SCRIPT_NAME'] = $script;
chdir(__DIR__);
require __DIR__ . $script;

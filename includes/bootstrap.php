<?php
/**
 * Loaded first by every page. Defines paths, then pulls in settings,
 * helpers, icons and the content registry.
 */
declare(strict_types=1);

define('ROOT', dirname(__DIR__));
// Install directory, so the site also runs from a sub-folder (and 404.php
// resolves assets correctly when Apache serves it for a deep missing path).
define('BASE', rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/'));

require __DIR__ . '/config.php';
require __DIR__ . '/helpers.php';
require __DIR__ . '/icons.php';
require __DIR__ . '/data.php';
require __DIR__ . '/enquiry.php';

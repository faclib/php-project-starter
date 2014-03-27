<?php

use ApacheVhost\Console\ApacheVhostApplication;
use Symfony\Component\Filesystem\Filesystem;

// Try to find the appropriate autoloader.
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require __DIR__ . '/../vendor/autoload.php';
} elseif (__DIR__ . '/../../../autoload.php') {
    require __DIR__ . '/../../../autoload.php';
}

$application = new ApacheVhostApplication(new Filesystem());
$application->run();

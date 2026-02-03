<?php

declare(strict_types=1);

$filesToRemove = [
    'README.md',
    'resources/images/users-table.png',
    'resources/images/tests.png',
    'resources/images/login-page.png',
    'resources/images',
    'app/Console/Commands/Welcome.php',
    '.github/FUNDING.yml',
    __FILE__,
];

foreach ($filesToRemove as $file) {
    if (file_exists($file)) {
        if (is_file($file)) {
            unlink($file);
        } elseif (is_dir($file)) {
            removeDirectory($file);
        }
    }
}

file_put_contents('README.md', '');

function removeDirectory(string $dir): bool
{
    if (! is_dir($dir)) {
        return false;
    }

    $files = array_diff(scandir($dir), ['.', '..']);

    foreach ($files as $file) {
        $path = realpath($dir.DIRECTORY_SEPARATOR.$file);

        if ($path === false) {
            continue;
        }

        if (is_dir($path)) {
            removeDirectory($path);
        } else {
            unlink($path);
        }
    }

    return rmdir($dir);
}

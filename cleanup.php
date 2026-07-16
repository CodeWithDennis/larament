<?php

declare(strict_types=1);

$filesToRemove = [
    'app/Console/Commands/Welcome.php',
    __FILE__,
];

foreach ($filesToRemove as $file) {
    if (is_file($file)) {
        unlink($file);
    }
}

file_put_contents('README.md', '');

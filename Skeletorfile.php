<?php

use NiftyCo\Skeletor\Skeletor;

return function (Skeletor $skeletor) {
    // Update the application name
    $name = $skeletor->text('Enter the application name:', 'Laravel');

    if ($name) {
        $skeletor->pregReplaceInFile('/^APP_NAME=(.*)$/m', 'APP_NAME='.$name, '.env');
    }

    // Update the demo user email
    $email = $skeletor->text('Enter the demo email:', 'admin@example.com');

    if ($email) {
        $skeletor->pregReplaceInFile('/^DEFAULT_USER_EMAIL=(".*?"|[^"\s]*|)$/m', 'DEFAULT_USER_EMAIL='.$email, '.env');
    }

    // Update the demo user password
    $password = $skeletor->password('Enter the demo password:', 'password');

    if ($password) {
        $skeletor->pregReplaceInFile('/^DEFAULT_USER_PASSWORD=(".*?"|[^"\s]*|)$/m', 'DEFAULT_USER_PASSWORD='.$password, '.env');
    }
};

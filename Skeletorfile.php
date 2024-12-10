<?php

use NiftyCo\Skeletor\Skeletor;

return function (Skeletor $skeletor) {
    $applicationName = $skeletor->text('Enter the application name:', 'Laravel', required: true);
    $name = $skeletor->text('Enter the demo username', 'John Doe', required: true);
    $email = $skeletor->text('Enter the demo email:', 'admin@example.com', required: true);
    $password = $skeletor->password('Enter the demo password:', 'password', required: true);
    $timezone = $skeletor->search('Which timezone do you want to use? ', fn (string $query) => collect(timezone_identifiers_list())
        ->filter(fn (string $timezone) => str_contains(strtolower($timezone), strtolower($query)))
        ->values()
        ->all());

    // If the user entered a name, replace the APP_NAME value in the .env file
    if ($applicationName) {
        $skeletor->pregReplaceInFile('/^APP_NAME=(.*)$/m', 'APP_NAME="'.$applicationName.'"', '.env');
    }

    // If the user entered a name, replace the DEFAULT_USER_NAME value in the .env file
    if ($name) {
        $skeletor->pregReplaceInFile('/^DEFAULT_USER_NAME=(".*?"|[^"\s]*|)$/m', 'DEFAULT_USER_NAME="'.$name.'"', '.env');
    }

    // If the user entered an email, replace the DEFAULT_USER_EMAIL value in the .env file
    if ($email) {
        $skeletor->pregReplaceInFile('/^DEFAULT_USER_EMAIL=(".*?"|[^"\s]*|)$/m', 'DEFAULT_USER_EMAIL="'.$email.'"', '.env');
    }

    // If the user entered a password, replace the DEFAULT_USER_PASSWORD value in the .env file
    if ($password) {
        $skeletor->pregReplaceInFile('/^DEFAULT_USER_PASSWORD=(".*?"|[^"\s]*|)$/m', 'DEFAULT_USER_PASSWORD="'.$password.'"', '.env');
    }

    // If the user entered a timezone, replace the APP_TIMEZONE value in the .env file
    if ($timezone) {
        $skeletor->pregReplaceInFile('/^APP_TIMEZONE=(".*?"|[^"\s]*|)$/m', 'APP_TIMEZONE="'.$timezone.'"', '.env');
    }
};

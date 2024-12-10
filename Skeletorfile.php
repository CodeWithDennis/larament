<?php

use NiftyCo\Skeletor\Skeletor;

return function (Skeletor $skeletor) {
    $name = $skeletor->text('Enter the application name:', 'Laravel');
    $email = $skeletor->text('Enter the demo email:', 'admin@example.com');
    $password = $skeletor->password('Enter the demo password:', 'password');
    $timezone = $skeletor->search('Which timezone do you want to use? ', fn ($query) => collect(timezone_identifiers_list())
        ->filter(fn ($timezone) => str_contains(strtolower($timezone), strtolower($query)))
        ->values()
        ->all());

    // If the user entered a name, replace the APP_NAME value in the .env file
    if ($name) {
        $skeletor->pregReplaceInFile('/^APP_NAME=(.*)$/m', 'APP_NAME='.$name, '.env');
    }

    // If the user entered an email, replace the DEFAULT_USER_EMAIL value in the .env file
    if ($email) {
        $skeletor->pregReplaceInFile('/^DEFAULT_USER_EMAIL=(".*?"|[^"\s]*|)$/m', 'DEFAULT_USER_EMAIL='.$email, '.env');
    }

    // If the user entered a password, replace the DEFAULT_USER_PASSWORD value in the .env file
    if ($password) {
        $skeletor->pregReplaceInFile('/^DEFAULT_USER_PASSWORD=(".*?"|[^"\s]*|)$/m', 'DEFAULT_USER_PASSWORD='.$password, '.env');
    }

    // If the user entered a timezone, replace the APP_TIMEZONE value in the .env file
    if ($timezone) {
        $skeletor->pregReplaceInFile('/^APP_TIMEZONE=(".*?"|[^"\s]*|)$/m', 'APP_TIMEZONE='.$timezone, '.env');
    }
};

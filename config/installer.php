<?php

// config for DanTheCoder/Installer
return [
    // The minimum required php version
    'php_version' => 8.1,

    // Enable if the app uses jetstream teams
    'jetstream_teams' => false,

    // The session driver to be used
    'session_driver' => 'file',

    // The services that will be configured
    'services' => [
        'mail' => true,
        'pusher' => true,
        'queue' => true,
        'filesystem' => true,
        'openai' => true,
    ],

    // Option to set other env variables
    'other_env_variables' => [
        'logo' => [
            'label' => 'Logo URL',
            'name' => 'LOGO_URL',
            'type' => 'text',
            'value' => '',
        ],
        'favicon' => [
            'label' => 'Favicon URL',
            'name' => 'FAVICON_URL',
            'type' => 'text',
            'value' => '',
        ],
    ],

    'completed' => env('INSTALLER_COMPLETED', false),
];

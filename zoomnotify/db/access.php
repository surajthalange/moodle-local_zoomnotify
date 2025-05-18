<?php
// Capability definitions for the plugin.

defined('MOODLE_INTERNAL') || die();

$capabilities = [
    'local/zoomnotify:receivenotification' => [
        'captype' => 'read',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => [
            'student' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
        ],
    ],
];

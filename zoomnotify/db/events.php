<?php
// Event observer mappings.

defined('MOODLE_INTERNAL') || die();

$observers = [
    [
        'eventname' => '\core\event\course_module_created',
        'callback' => 'local_zoomnotify_course_module_created',
    ],
];

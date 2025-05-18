<?php
defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_zoomnotify', get_string('pluginname', 'local_zoomnotify'));

    $settings->add(new admin_setting_configcheckbox(
        'local_zoomnotify/enable',
        'Enable Zoom Notifications',
        'If enabled, emails will be sent when a Zoom activity is added.',
        1
    ));

    $settings->add(new admin_setting_configtext(
        'local_zoomnotify/roles',
        'Notify Roles',
        'Comma-separated list of Moodle role shortnames to notify (e.g., student)',
        'student'
    ));

    $ADMIN->add('localplugins', $settings);
}

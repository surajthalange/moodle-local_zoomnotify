<?php
// Language strings for plugin.

$string['pluginname'] = 'Zoom Notification';
$string['emailsubject'] = 'New Zoom meeting: {$a}';
$string['emailbodytext'] = 'A new Zoom meeting has been added to your course "{$a->coursename}". Meeting: "{$a->meetingname}", Time: {$a->starttime}, Duration: {$a->duration} minutes. Join here: {$a->url}';
$string['emailbodyhtml'] = 'A new Zoom meeting has been added to your course <strong>{$a->coursename}</strong>.<br><strong>Meeting:</strong> {$a->meetingname}<br><strong>Time:</strong> {$a->starttime}<br><strong>Duration:</strong> {$a->duration} minutes<br><strong>Join:</strong> <a href="{$a->url}">{$a->url}</a>';
$string['eventemailsent'] = 'Zoom meeting email sent';
$string['receivenotification'] = 'Receive Zoom meeting notifications';
$string['roles'] = 'Roles to notify';
$string['roles_desc'] = 'Comma-separated list of shortnames of roles to receive notifications.';

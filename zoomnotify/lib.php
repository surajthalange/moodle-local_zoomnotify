<?php
// Library file containing hook implementations for the plugin.

defined('MOODLE_INTERNAL') || die();

/**
 * Callback observer that sends email to users when a Zoom activity is created.
 *
 * @param \core\event\course_module_created $event
 * @return void
 */
function local_zoomnotify_course_module_created(\core\event\course_module_created $event): void
{
    global $DB;

    if ($event->other['modulename'] !== 'zoom') {
        return;
    }

    $cmid = $event->contextinstanceid;
    $cm = get_coursemodule_from_id('zoom', $cmid);
    if (!$cm) {
        return;
    }

    $zoom = $DB->get_record('zoom', ['id' => $cm->instance], '*', IGNORE_MISSING);
    if (!$zoom) {
        return;
    }

    $context = context_course::instance($cm->course);
    $users = get_enrolled_users($context);

    foreach ($users as $user) {
        // Check if user has permission to receive notifications.
        if (!has_capability('local/zoomnotify:receivenotification', $context, $user)) {
            continue;
        }

        // Check if user's role is allowed (based on settings).
        $allowedroles = explode(',', get_config('local_zoomnotify', 'roles'));
        $userroles = get_user_roles($context, $user->id);

        $roleallowed = false;
        foreach ($userroles as $role) {
            if (in_array($role->shortname, $allowedroles)) {
                $roleallowed = true;
                break;
            }
        }

        if (!$roleallowed) {
            continue;
        }

        // Format time.
        $starttime = userdate($zoom->start_time, get_string('strftimedatetime', 'langconfig'));

        // Prepare email content.
        $subject = get_string('emailsubject', 'local_zoomnotify', format_string($zoom->name));
        $body = get_string('emailbodytext', 'local_zoomnotify', [
            'coursename' => format_string($cm->course),
            'meetingname' => format_string($zoom->name),
            'starttime' => $starttime,
            'duration' => $zoom->duration,
            'url' => $zoom->join_url,
        ]);

        $htmlbody = '<p>' . get_string('emailbodyhtml', 'local_zoomnotify', [
            'coursename' => format_string($cm->course),
            'meetingname' => format_string($zoom->name),
            'starttime' => $starttime,
            'duration' => $zoom->duration,
            'url' => $zoom->join_url,
        ]) . '</p>';

        email_to_user($user, core_user::get_support_user(), $subject, $body, $htmlbody);

        // Trigger custom event for logging.
        $eventdata = \local_zoomnotify\event\email_sent::create([
            'objectid' => $zoom->id,
            'context' => $context,
            'userid' => $user->id,
        ]);
        $eventdata->trigger();
    }
}

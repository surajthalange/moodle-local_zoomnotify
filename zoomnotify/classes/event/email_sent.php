<?php
// Custom event class to log when emails are sent.

namespace local_zoomnotify\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Event triggered when a notification email is sent.
 */
class email_sent extends \core\event\base
{

    protected function init(): void
    {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
    }

    public static function get_name(): string
    {
        return get_string('eventemailsent', 'local_zoomnotify');
    }

    public function get_description(): string
    {
        return "Email notification sent to user with ID {$this->userid} for Zoom activity with ID {$this->objectid}.";
    }

    public function get_url(): \moodle_url
    {
        return new \moodle_url('/mod/zoom/view.php', ['id' => $this->objectid]);
    }
}

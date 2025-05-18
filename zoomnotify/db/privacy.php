<?php
// Privacy API implementation.

namespace local_zoomnotify\privacy;

use core_privacy\local\metadata\provider;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy provider for local_zoomnotify plugin.
 *
 * This plugin does not store personal data.
 */
class provider implements provider
{
    public static function get_metadata(\core_privacy\local\metadata\collection $collection): \core_privacy\local\metadata\collection
    {
        return $collection;
    }
}

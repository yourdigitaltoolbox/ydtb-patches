<?php

namespace YDTBPatches\Patches;

use YDTBPatches\Interfaces\Provider;

class HideAdminNotices implements Provider
{
    public function register()
    {
        add_action('in_admin_header', [$this, 'disable_some_admin_notices']);
    }

    public function disable_some_admin_notices()
    {

        // This global object is used to store all plugins callbacks for different hooks
        global $wp_filter;

        // Here we define the strings that we don't want to appear in any messages
        // Retrieve the forbidden message strings from the database
        $forbidden_message_strings = get_option('hide_admin_notice_strings', []);

        // Now we can loop over each of the admin_notice callbacks
        foreach ($wp_filter['admin_notices'] as $weight => $callbacks) {
            foreach ($callbacks as $name => $details) {

                // Start an output buffer and call the callback
                ob_start();
                call_user_func($details['function']);
                $message = ob_get_clean();

                // Check if this contains our forbidden string
                foreach ($forbidden_message_strings as $forbidden_string) {
                    if (strpos($message, $forbidden_string) !== FALSE) {
                        // Found it - under this callback
                        $wp_filter['admin_notices']->remove_filter('admin_notices', $details['function'], $weight);
                    }
                }
            }
        }
    }
}

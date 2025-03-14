<?php

namespace YDTBPatchesRoot;

use YDTBPatches\Utils\Updater;
use YDTBPatches\Patches\SilenceTextDomainNotice;

class Plugin
{
    private $plugin_path;

    public function __construct()
    {
        if (!$this->plugin_checks()) {
            // still run the safe providers like the updater if the plugin checks fail
            foreach ($this->safeProviders() as $service) {
                (new $service)->register();
            }
            return;
        }
        $this->register();
    }

    /**
     * Register the providers
     */

    protected function providers()
    {
        return [
            SilenceTextDomainNotice::class,
            Updater::class
        ];
    }

    protected function safeProviders()
    {
        return [
            Updater::class
        ];
    }

    /**
     * Run each providers' register function
     */

    protected function register()
    {
        foreach ($this->providers() as $service) {
            (new $service)->register();
        }
    }

    /**
     * Check if the plugin has been built + anything else you want to check prior to booting the plugin
     */

    public function plugin_checks()
    {
        if (!function_exists('is_plugin_active'))
            require_once(ABSPATH . '/wp-admin/includes/plugin.php');

        // if (!is_plugin_active('s3-uploads/s3-uploads.php')) {
        //     add_action('admin_notices', function () {
        //         echo '<div class="notice notice-error"><p>S3 Uploads must be installed and activated for S3-Uploads-Patch plugin to work.</p></div>';
        //     });
        //     return false;
        // }
        return true;
    }
}

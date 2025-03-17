<?php

/**
 * Plugin Name: YDTB Wordpress Patches
 * Plugin URI:  https://yourdigitaltoolbox.com/
 * Description: A collection of patches for Wordpress core and plugins to fix bugs and add features.
 * Author:      John Kraczek
 * Author URI:  https://yourdigitaltoolbox.com/
 * Version:     0.0.6
 * Text Domain: ydtb-patches
 * Domain Path: /languages/
 * License:     GPLv3 or later (license.txt)
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

// check if the vendor directory exists, and load it if it does
$autoload = __DIR__ . '/vendor/autoload.php';

if (!file_exists(filename: $autoload)) {
    add_action(hook_name: 'admin_notices', callback: function (): void {
        $message = __(text: 'YDTB Patches was downloaded from source and has not been built. Please run `composer install` inside the plugin directory <br> OR <br> install a released version of the plugin which will have already been built.', domain: 'ydtb-patches');
        echo '<div class="notice notice-error">';
        echo '<p>' . $message . '</p>';
        echo '</div>';
    });
    return false;
}
require_once $autoload;

new YDTBPatchesRoot\Plugin();

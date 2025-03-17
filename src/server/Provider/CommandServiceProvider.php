<?php

namespace YDTBPatches\Provider;

use YDTBPatches\Interfaces\Provider;
use YDTBPatches\Commands\AdminNoticeCLI;

class CommandServiceProvider implements Provider
{
    public function register()
    {
        if (!defined('WP_CLI') || !WP_CLI) {
            return;
        }

        \WP_CLI::add_command('hide-notice', AdminNoticeCLI::class);
    }
}
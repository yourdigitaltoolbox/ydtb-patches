<?php

namespace YDTBPatches\Patches;

use YDTBPatches\Interfaces\Provider;

class SilenceTextDomainNotice implements Provider
{
    public function register()
    {
        add_filter(
            'doing_it_wrong_trigger_error',
            function ($value, $function_name) {
                if ('_load_textdomain_just_in_time' === $function_name) {
                    return false;
                }
                return $value;
            },
            10,
            4
        );
    }
}

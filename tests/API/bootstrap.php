<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

set_error_handler(function($level, $message) {
    if ($level === E_DEPRECATED || $level === E_USER_DEPRECATED) {
        return true;
    }

    return false;
});

require_once __DIR__.'/../../vendor/autoload.php';

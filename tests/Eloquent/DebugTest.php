<?php

namespace Dapodik\Laravel\Eloquent\Tests;

use PHPUnit\Framework\TestCase;

class DebugTest extends TestCase
{
    /** @test */
    public function check_error_reporting()
    {
        echo "\nerror_reporting: ".error_reporting()."\n";
        echo 'E_DEPRECATED: '.E_DEPRECATED."\n";
        echo 'has E_DEPRECATED: '.(error_reporting() & E_DEPRECATED)."\n";
        echo 'E_USER_DEPRECATED: '.E_USER_DEPRECATED."\n";
        echo 'has E_USER_DEPRECATED: '.(error_reporting() & E_USER_DEPRECATED)."\n";
        $this->assertTrue(true);
    }
}

<?php

test('error reporting suppresses deprecation warnings', function () {
    expect(error_reporting() & E_DEPRECATED)->toBe(0);
    expect(error_reporting() & E_USER_DEPRECATED)->toBe(0);
});

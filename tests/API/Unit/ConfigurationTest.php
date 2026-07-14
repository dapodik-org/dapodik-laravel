<?php

use Dapodik\Laravel\API\Concerns\Configuration;

function invokeMethod($object, string $methodName, array $parameters = []): mixed
{
    $reflection = new ReflectionClass(get_class($object));
    $method = $reflection->getMethod($methodName);
    $method->setAccessible(true);

    return $method->invokeArgs($object, $parameters);
}

it('parses valid driver', function () {
    $config = new class
    {
        use Configuration;
    };

    $result = invokeMethod($config, 'parseDriver', [['driver' => 'rest']]);

    $this->assertEquals(['driver' => 'rest'], $result);
});

it('throws for invalid driver', function () {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Driver [invalid] not supported.');

    $config = new class
    {
        use Configuration;
    };
    invokeMethod($config, 'parseDriver', [['driver' => 'invalid']]);
});

it('parses host', function () {
    $config = new class
    {
        use Configuration;
    };

    $result = invokeMethod($config, 'parseHost', [['host' => 'http://localhost']]);

    $this->assertEquals(['host' => 'http://localhost'], $result);
});

it('throws without host', function () {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Host is required.');

    $config = new class
    {
        use Configuration;
    };
    invokeMethod($config, 'parseHost', [[]]);
});

it('parses username', function () {
    $config = new class
    {
        use Configuration;
    };

    $result = invokeMethod($config, 'parseUsername', [['username' => 'user']]);

    $this->assertEquals(['username' => 'user'], $result);
});

it('throws without username', function () {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Username is required.');

    $config = new class
    {
        use Configuration;
    };
    invokeMethod($config, 'parseUsername', [[]]);
});

it('parses password', function () {
    $config = new class
    {
        use Configuration;
    };

    $result = invokeMethod($config, 'parsePassword', [['password' => 'secret']]);

    $this->assertEquals(['password' => 'secret'], $result);
});

it('throws without password', function () {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Password is required.');

    $config = new class
    {
        use Configuration;
    };
    invokeMethod($config, 'parsePassword', [[]]);
});

it('parses kode registrasi', function () {
    $config = new class
    {
        use Configuration;
    };

    $result = invokeMethod($config, 'parseKodeRegistrasi', [['kode_registrasi' => 'abc123']]);

    $this->assertEquals(['kode_registrasi' => 'abc123'], $result);
});

it('throws without kode registrasi', function () {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Kode Registrasi is required.');

    $config = new class
    {
        use Configuration;
    };
    invokeMethod($config, 'parseKodeRegistrasi', [[]]);
});

it('parses npsn', function () {
    $config = new class
    {
        use Configuration;
    };

    $result = invokeMethod($config, 'parseNpsn', [['npsn' => '12345678']]);

    $this->assertEquals(['npsn' => '12345678'], $result);
});

it('throws without npsn', function () {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('NPSN is required.');

    $config = new class
    {
        use Configuration;
    };
    invokeMethod($config, 'parseNpsn', [[]]);
});

it('parses token', function () {
    $config = new class
    {
        use Configuration;
    };

    $result = invokeMethod($config, 'parseToken', [['token' => 'tokensecret']]);

    $this->assertEquals(['token' => 'tokensecret'], $result);
});

it('throws without token', function () {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Token is required.');

    $config = new class
    {
        use Configuration;
    };
    invokeMethod($config, 'parseToken', [[]]);
});

it('returns supported drivers', function () {
    $config = new class
    {
        use Configuration;
    };

    $drivers = invokeMethod($config, 'supportDrivers');

    $this->assertEquals(['rest', 'webservice'], $drivers);
});

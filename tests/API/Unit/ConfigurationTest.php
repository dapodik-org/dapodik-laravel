<?php

namespace Dapodik\Laravel\API\Tests\Unit;

use Dapodik\Laravel\API\Concerns\Configuration;
use Dapodik\Laravel\API\Tests\TestCase;

class ConfigurationTest extends TestCase
{
    /** @test */
    public function it_parses_valid_driver()
    {
        $config = $this->getMockForTrait(Configuration::class);

        $result = $this->invokeMethod($config, 'parseDriver', [['driver' => 'rest']]);

        $this->assertEquals(['driver' => 'rest'], $result);
    }

    /** @test */
    public function it_throws_for_invalid_driver()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Driver [invalid] not supported.');

        $config = $this->getMockForTrait(Configuration::class);
        $this->invokeMethod($config, 'parseDriver', [['driver' => 'invalid']]);
    }

    /** @test */
    public function it_parses_host()
    {
        $config = $this->getMockForTrait(Configuration::class);

        $result = $this->invokeMethod($config, 'parseHost', [['host' => 'http://localhost']]);

        $this->assertEquals(['host' => 'http://localhost'], $result);
    }

    /** @test */
    public function it_throws_without_host()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Host is required.');

        $config = $this->getMockForTrait(Configuration::class);
        $this->invokeMethod($config, 'parseHost', [[]]);
    }

    /** @test */
    public function it_parses_username()
    {
        $config = $this->getMockForTrait(Configuration::class);

        $result = $this->invokeMethod($config, 'parseUsername', [['username' => 'user']]);

        $this->assertEquals(['username' => 'user'], $result);
    }

    /** @test */
    public function it_throws_without_username()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Username is required.');

        $config = $this->getMockForTrait(Configuration::class);
        $this->invokeMethod($config, 'parseUsername', [[]]);
    }

    /** @test */
    public function it_parses_password()
    {
        $config = $this->getMockForTrait(Configuration::class);

        $result = $this->invokeMethod($config, 'parsePassword', [['password' => 'secret']]);

        $this->assertEquals(['password' => 'secret'], $result);
    }

    /** @test */
    public function it_throws_without_password()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Password is required.');

        $config = $this->getMockForTrait(Configuration::class);
        $this->invokeMethod($config, 'parsePassword', [[]]);
    }

    /** @test */
    public function it_parses_kode_registrasi()
    {
        $config = $this->getMockForTrait(Configuration::class);

        $result = $this->invokeMethod($config, 'parseKodeRegistrasi', [['kode_registrasi' => 'abc123']]);

        $this->assertEquals(['kode_registrasi' => 'abc123'], $result);
    }

    /** @test */
    public function it_throws_without_kode_registrasi()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Kode Registrasi is required.');

        $config = $this->getMockForTrait(Configuration::class);
        $this->invokeMethod($config, 'parseKodeRegistrasi', [[]]);
    }

    /** @test */
    public function it_parses_npsn()
    {
        $config = $this->getMockForTrait(Configuration::class);

        $result = $this->invokeMethod($config, 'parseNpsn', [['npsn' => '12345678']]);

        $this->assertEquals(['npsn' => '12345678'], $result);
    }

    /** @test */
    public function it_throws_without_npsn()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('NPSN is required.');

        $config = $this->getMockForTrait(Configuration::class);
        $this->invokeMethod($config, 'parseNpsn', [[]]);
    }

    /** @test */
    public function it_parses_token()
    {
        $config = $this->getMockForTrait(Configuration::class);

        $result = $this->invokeMethod($config, 'parseToken', [['token' => 'tokensecret']]);

        $this->assertEquals(['token' => 'tokensecret'], $result);
    }

    /** @test */
    public function it_throws_without_token()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Token is required.');

        $config = $this->getMockForTrait(Configuration::class);
        $this->invokeMethod($config, 'parseToken', [[]]);
    }

    /** @test */
    public function it_returns_supported_drivers()
    {
        $config = $this->getMockForTrait(Configuration::class);

        $drivers = $this->invokeMethod($config, 'supportDrivers');

        $this->assertEquals(['rest', 'webservice'], $drivers);
    }

    protected function invokeMethod($object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}

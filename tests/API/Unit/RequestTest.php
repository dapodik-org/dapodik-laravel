<?php

namespace Dapodik\Laravel\API\Tests\Unit;

use Dapodik\Laravel\API\Concerns\Request;
use Dapodik\Laravel\API\Tests\TestCase;

class RequestTest extends TestCase
{
    protected function getRequestMock()
    {
        return new class
        {
            use Request {
                setHeaders as public;
                getHeaders as public;
                setQuery as public;
                getQuery as public;
                setFormParams as public;
                getFormParams as public;
                forgeOptions as public;
            }

            public $config = ['options' => []];
        };
    }

    /** @test */
    public function it_sets_and_gets_headers()
    {
        $request = $this->getRequestMock();

        $request->setHeaders('Authorization', 'Bearer token123');

        $this->assertEquals('Bearer token123', $request->getHeaders('Authorization'));
    }

    /** @test */
    public function it_returns_all_headers()
    {
        $request = $this->getRequestMock();

        $request->setHeaders('X-Foo', 'bar');
        $request->setHeaders('X-Baz', 'qux');

        $headers = $request->getHeaders();
        $this->assertArrayHasKey('X-Foo', $headers);
        $this->assertArrayHasKey('X-Baz', $headers);
    }

    /** @test */
    public function it_sets_and_gets_query_params()
    {
        $request = $this->getRequestMock();

        $request->setQuery('npsn', '12345678');

        $this->assertEquals('12345678', $request->getQuery('npsn'));
    }

    /** @test */
    public function it_returns_all_query_params()
    {
        $request = $this->getRequestMock();

        $request->setQuery('a', '1');
        $request->setQuery('b', '2');

        $query = $request->getQuery();
        $this->assertArrayHasKey('a', $query);
        $this->assertArrayHasKey('b', $query);
    }

    /** @test */
    public function it_sets_and_gets_form_params()
    {
        $request = $this->getRequestMock();

        $request->setFormParams('username', 'user123');

        $this->assertEquals('user123', $request->getFormParams('username'));
    }

    /** @test */
    public function it_returns_all_form_params()
    {
        $request = $this->getRequestMock();

        $request->setFormParams('username', 'user');
        $request->setFormParams('password', 'pass');

        $params = $request->getFormParams();
        $this->assertArrayHasKey('username', $params);
        $this->assertArrayHasKey('password', $params);
    }

    /** @test */
    public function it_forges_options()
    {
        $request = $this->getRequestMock();
        $request->config['options'] = ['form_params' => ['a' => 1], 'query' => ['b' => 2]];

        $request->forgeOptions('form_params');

        $this->assertArrayNotHasKey('form_params', $request->config['options']);
        $this->assertArrayHasKey('query', $request->config['options']);
    }
}

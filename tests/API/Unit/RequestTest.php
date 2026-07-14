<?php

use Dapodik\Laravel\API\Concerns\Request;

function requestMock(): object
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

it('sets and gets headers', function () {
    $request = requestMock();

    $request->setHeaders('Authorization', 'Bearer token123');

    $this->assertEquals('Bearer token123', $request->getHeaders('Authorization'));
});

it('returns all headers', function () {
    $request = requestMock();

    $request->setHeaders('X-Foo', 'bar');
    $request->setHeaders('X-Baz', 'qux');

    $headers = $request->getHeaders();
    $this->assertArrayHasKey('X-Foo', $headers);
    $this->assertArrayHasKey('X-Baz', $headers);
});

it('sets and gets query params', function () {
    $request = requestMock();

    $request->setQuery('npsn', '12345678');

    $this->assertEquals('12345678', $request->getQuery('npsn'));
});

it('returns all query params', function () {
    $request = requestMock();

    $request->setQuery('a', '1');
    $request->setQuery('b', '2');

    $query = $request->getQuery();
    $this->assertArrayHasKey('a', $query);
    $this->assertArrayHasKey('b', $query);
});

it('sets and gets form params', function () {
    $request = requestMock();

    $request->setFormParams('username', 'user123');

    $this->assertEquals('user123', $request->getFormParams('username'));
});

it('returns all form params', function () {
    $request = requestMock();

    $request->setFormParams('username', 'user');
    $request->setFormParams('password', 'pass');

    $params = $request->getFormParams();
    $this->assertArrayHasKey('username', $params);
    $this->assertArrayHasKey('password', $params);
});

it('forges options', function () {
    $request = requestMock();
    $request->config['options'] = ['form_params' => ['a' => 1], 'query' => ['b' => 2]];

    $request->forgeOptions('form_params');

    $this->assertArrayNotHasKey('form_params', $request->config['options']);
    $this->assertArrayHasKey('query', $request->config['options']);
});

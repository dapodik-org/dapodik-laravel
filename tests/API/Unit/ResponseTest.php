<?php

use Dapodik\Laravel\API\Response;
use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Support\Collection;

function successResponse(): Psr7Response
{
    $body = json_encode(['success' => true, 'data' => ['key' => 'value']]);

    return new Psr7Response(200, ['Content-Type' => 'application/json'], $body);
}

function errorResponse(): Psr7Response
{
    $body = json_encode(['success' => false, 'message' => 'Not found', 'http_code' => 404]);

    return new Psr7Response(404, ['Content-Type' => 'application/json'], $body);
}

it('stores response data', function () {
    $psrResponse = successResponse();
    $response = new Response($psrResponse);

    $this->assertEquals('value', $response->content()['data']['key']);
});

it('converts to array', function () {
    $response = new Response(successResponse());

    $this->assertIsArray($response->toArray());
    $this->assertArrayHasKey('data', $response->toArray());
});

it('converts to collection', function () {
    $response = new Response(successResponse());

    $collection = $response->toCollection();

    $this->assertInstanceOf(Collection::class, $collection);
    $this->assertEquals('value', $collection->get('data')['key']);
});

it('converts to json', function () {
    $response = new Response(successResponse());

    $json = $response->toJson();

    $this->assertJson($json);
    $this->assertArrayHasKey('data', json_decode($json, true));
});

it('throws on error response', function () {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Not found');

    $response = new Response(errorResponse());
    $response->content();
});

it('stringifies to body content', function () {
    $psrResponse = successResponse();
    $response = new Response($psrResponse);

    $this->assertJson($response->__toString());
});

<?php

namespace Dapodik\Laravel\API\Tests\Unit;

use Dapodik\Laravel\API\Response;
use Dapodik\Laravel\API\Tests\TestCase;
use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Support\Collection;

class ResponseTest extends TestCase
{
    protected function getSuccessResponse()
    {
        $body = json_encode(['success' => true, 'data' => ['key' => 'value']]);

        return new Psr7Response(200, ['Content-Type' => 'application/json'], $body);
    }

    protected function getErrorResponse()
    {
        $body = json_encode(['success' => false, 'message' => 'Not found', 'http_code' => 404]);

        return new Psr7Response(404, ['Content-Type' => 'application/json'], $body);
    }

    /** @test */
    public function it_stores_response_data()
    {
        $psrResponse = $this->getSuccessResponse();
        $response = new Response($psrResponse);

        $this->assertEquals('value', $response->content()['data']['key']);
    }

    /** @test */
    public function it_converts_to_array()
    {
        $response = new Response($this->getSuccessResponse());

        $this->assertIsArray($response->toArray());
        $this->assertArrayHasKey('data', $response->toArray());
    }

    /** @test */
    public function it_converts_to_collection()
    {
        $response = new Response($this->getSuccessResponse());

        $collection = $response->toCollection();

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertEquals('value', $collection->get('data')['key']);
    }

    /** @test */
    public function it_converts_to_json()
    {
        $response = new Response($this->getSuccessResponse());

        $json = $response->toJson();

        $this->assertJson($json);
        $this->assertArrayHasKey('data', json_decode($json, true));
    }

    /** @test */
    public function it_throws_on_error_response()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Not found');

        $response = new Response($this->getErrorResponse());
        $response->content();
    }

    /** @test */
    public function it_stringifies_to_body_content()
    {
        $psrResponse = $this->getSuccessResponse();
        $response = new Response($psrResponse);

        $this->assertJson($response->__toString());
    }
}

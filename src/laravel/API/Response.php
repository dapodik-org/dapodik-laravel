<?php

namespace Dapodik\Laravel\API;

use Dapodik\Laravel\API\Contracts\ResponseContract;
use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;

class Response implements ResponseContract
{
    protected $reasonPhrase;

    protected $statusCode;

    protected $headers;

    protected $protocol;

    protected $stream;

    protected $content;

    protected $stringContent;

    public function __construct(ResponseInterface $response)
    {
        $this->reasonPhrase = $response->getReasonPhrase();
        $this->statusCode = $response->getStatusCode();
        $this->headers = $response->getHeaders();
        $this->protocol = $response->getProtocolVersion();
        $this->stream = $response->getBody();
    }

    public function content()
    {
        if (is_null($this->content)) {
            $content = self::__toString();

            if (! is_null($error = preg_match("/\{.*?['\"]success['\"]:.*?false,(.*?)}/", $content, $match) ? $match[0] : null)) {
                throw new \InvalidArgumentException(json_decode($error)->message, json_decode($error)->http_code);
            }

            $this->content = (array) json_decode($content, true);
        }

        return $this->content;
    }

    public function __toString()
    {
        if (is_null($this->stringContent)) {
            $this->stringContent = $this->stream->getContents();
        }

        return $this->stringContent;
    }

    public function toArray()
    {
        return $this->content();
    }

    public function toCollection()
    {
        return new Collection($this->content());
    }

    public function toJson($flags = 0, $depth = 512)
    {
        return json_encode($this->content(), $flags, $depth);
    }
}

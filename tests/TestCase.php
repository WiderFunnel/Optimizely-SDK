<?php

namespace WiderFunnel\Tests;

use PHPUnit_Framework_TestCase;

/**
 * Class TestCase
 */
class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @param array $attributes
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    public function fakeClient($attributes = [])
    {
        if (is_string($attributes)) {
            $attributes = file_get_contents(__DIR__ . "/stubs/{$attributes}.json");
        }

        if (is_array($attributes)) {
            $attributes = json_encode($attributes);
        }

        $stream = $this->createMock(\GuzzleHttp\Psr7\Stream::class);
        $stream->method('getContents')->willReturn($attributes);

        $response = $this->createMock(\GuzzleHttp\Psr7\Response::class);
        $response->method('getBody')->willReturn($stream);

        $deleteResponse = $this->createMock(\GuzzleHttp\Psr7\Response::class);
        $deleteResponse->method('getBody')->willReturn(null);
        $deleteResponse->method('getStatusCode')->willReturn(204);

        $client = $this->createMock(\WiderFunnel\Http\Client::class);
        $client->method('get')->willReturn($response);
        $client->method('put')->willReturn($response);
        $client->method('post')->willReturn($response);
        $client->method('delete')->willReturn($deleteResponse);

        return $client;
    }

    /**
     * @param $stub
     * @return string
     */
    public function getStub($stub)
    {
        return __DIR__ . "/stubs/{$stub}.json";
    }
}
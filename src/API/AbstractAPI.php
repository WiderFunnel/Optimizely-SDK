<?php


namespace Optimizely\API;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;

/**
 * Class AbstractAPI
 * @package Optimizely\API
 */
abstract class AbstractAPI
{
    /**
     * @var
     */
    protected $client;

    /**
     * @var
     */
    protected $content;

    /**
     * Project constructor.
     * @param \GuzzleHttp\ClientInterface $client
     * @param $content
     */
    public function __construct(ClientInterface $client, Response $content)
    {
        $this->client = $client;
        $this->content = $content;
    }

    /**
     * @param $endpoint
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get($endpoint)
    {
        return $this->client->request('GET', $endpoint);
    }

    /**
     * @param $endpoint, $options
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post($endpoint, $options)
    {
        return $this->client->request('POST', $endpoint, ['body' => json_encode($options)]);
    }

    /**
     * @param $endpoint, $options
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function put($endpoint, $options)
    {
        return $this->client->request('PUT', $endpoint, ['body' => json_encode($options)]);
    }
}
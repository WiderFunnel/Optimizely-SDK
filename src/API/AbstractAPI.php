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
}
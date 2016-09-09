<?php

namespace Optimizely;

use GuzzleHttp\Client;
use Optimizely\API\Project;

/**
 * Class Optimizely
 * @package Optimizely
 */
class Optimizely
{

    protected $base_uri = 'https://www.optimizelyapis.com/experiment/v1/';

    /**
     * Optimizely constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $this->client = new Client([
            'base_uri' => $this->base_uri,
            'headers' => [
                'Accept'     => 'application/json',
                'Token'      => $token
            ]
        ]);
    }

    /**
     * @param $projectId
     * @return string
     */
    public function project($projectId)
    {
        $response = $this->client->request('GET', "projects/{$projectId}");

        return new Project($this->client, $response);
    }

    /**
     * @return string
     */
    public function projects() {
        $response = $this->client->request('GET', 'projects');

        return $response->getBody()->getContents();
    }
}
<?php

namespace Optimizely\API;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;

/**
 * Class Project
 * @package Optimizely\API
 */
class Project extends AbstractAPI
{

    protected $id;

    /**
     * Project constructor.
     * @param \GuzzleHttp\ClientInterface $client
     * @param $content
     */
    public function __construct(ClientInterface $client, Response $content)
    {
        parent::__construct($client, $content);

        $this->id = $this->getProjectId();
    }

    /**
     * @return mixed
     */
    public function getProjectId()
    {
        $response = json_decode($this->content->getBody()->getContents(), true);

        return $response['id'];
    }

    /**
     * @return mixed
     */
    public function experiments()
    {
        $response = $this->client->get("projects/{$this->id}/experiments");

        return $response->getBody()->getContents();
    }
    
    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->content->getBody()->getContents();
    }
}
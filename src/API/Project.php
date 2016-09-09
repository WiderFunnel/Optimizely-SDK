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
     * @param $experimentName, $editURL, $options
     * @return string
     */
    public function create($experimentName, $editURL, $options = [])
    {   
        $options['description'] = $experimentName;

        $options['edit_url'] = $editURL;

        $response = $this->client->request('POST', 'projects/' . $this->id . '/experiments', ['body' => json_encode($options)]);

        return $response->getBody()->getContents();
    }

    /**
     * @param $options
     * @return string
     */
    public function update($options)
    {   
        $response = $this->client->request('PUT','projects/' . $this->id, ['body' => json_encode($options)]);

        return $response->getBody()->getContents();
    }

    /**
     * @return string
     */
    public function archive()
    {   
        $options = ['project_status' => 'Archived'];

        $response = $this->client->request('PUT','projects/' . $this->id, ['body' => json_encode($options)]);

        return $response->getBody()->getContents();
    }

    /**
     * @return string
     */
    public function activate()
    {   
        $options = ['project_status' => 'Active'];

        $response = $this->client->request('PUT','projects/' . $this->id, ['body' => json_encode($options)]);

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
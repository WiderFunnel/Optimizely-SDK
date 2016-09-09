<?php

namespace Optimizely;

use GuzzleHttp\Client;
use Optimizely\API\Project;
use Optimizely\API\Experiment;
use Optimizely\API\Schedule;

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
                'Content-Type'      => 'application/json',
                'Token'             => $token
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

    /**
     * @param $projectName
     * @return string
     */
    public function create($projectName)
    {   
        $options = ['project_name' => $projectName];

        $response = $this->client->request('POST', 'projects', ['body' => json_encode($options)]);

        return $response->getBody()->getContents();
    }

    /**
     * @param $projectId
     * @return string
     */
    public function experiment($experimentId)
    {
        $response = $this->client->request('GET', "experiments/{$experimentId}");

        return new Experiment($this->client, $response);
    }

    /**
     * @param $scheduleId
     * @return string
     */
    public function schedule($scheduleId)
    {
        $response = $this->client->request('GET', "schedules/{$scheduleId}");

        return new Schedule($this->client, $response);
    }
}
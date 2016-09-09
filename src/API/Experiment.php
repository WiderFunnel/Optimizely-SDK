<?php

namespace Optimizely\API;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;

/**
 * Class Experiment
 * @package Optimizely\API
 */
class Experiment extends AbstractAPI
{

    protected $id;

    /**
     * Experiment constructor.
     * @param \GuzzleHttp\ClientInterface $client
     * @param $content
     */
    public function __construct(ClientInterface $client, Response $content)
    {
        parent::__construct($client, $content);

        $this->id = $this->getExperimentId();
    }

    /**
     * @return mixed
     */
    public function getExperimentId()
    {
        $response = json_decode($this->content->getBody()->getContents(), true);

        return $response['id'];
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
        $response = $this->client->request('PUT','experiments/' . $this->id, ['body' => json_encode($options)]);

        return $response->getBody()->getContents();
    }

    /**
     * @return mixed
     */
    public function launch()
    {
        $options = ['status' => 'Running'];

        $response = $this->client->request('PUT','experiments/' . $this->id, ['body' => json_encode($options)]);

        return $response->getBody()->getContents();
    }

    /**
     * @return mixed
     */
    public function pause()
    {
        $options = ['status' => 'Paused'];

        $response = $this->client->request('PUT','experiments/' . $this->id, ['body' => json_encode($options)]);

        return $response->getBody()->getContents();
    }

    /**
     * @return mixed
     */
    public function archive()
    {
        $options = ['status' => 'Archived'];

        $response = $this->client->request('PUT','experiments/' . $this->id, ['body' => json_encode($options)]);

        return $response->getBody()->getContents();
    }

    /**
     * @return string
     */
    public function schedules()
    {
        $response = $this->client->get('experiments/' . $this->id . '/schedules');

        return $response->getBody()->getContents();
    }

    /**
     * @param $startTime, $stopTime
     * @return string
     */
    public function schedule($startTime = null, $stopTime = null)
    {
        $options = [];

        $options['start_time'] = $startTime;

        $options['stop_time'] = $stopTime;

        $response = $this->client->request('POST', 'experiments/' . $this->id . '/schedules', ['body' => json_encode($options)]);

        return $response->getBody()->getContents();
    }

    /**
     * @return string
     */
    public function variations()
    {
        $response = $this->client->get('experiments/' . $this->id . '/variations');

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
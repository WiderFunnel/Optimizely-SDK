<?php

namespace Optimizely\API;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;

/**
 * Class Schedule
 * @package Optimizely\API
 */
class Schedule extends AbstractAPI
{

    protected $id;

    /**
     * Schedule constructor.
     * @param \GuzzleHttp\ClientInterface $client
     * @param $content
     */
    public function __construct(ClientInterface $client, Response $content)
    {
        parent::__construct($client, $content);

        $this->id = $this->getScheduleId();
    }

    /**
     * @return mixed
     */
    public function getScheduleId()
    {
        $response = json_decode($this->content->getBody()->getContents(), true);

        return $response['id'];
    }

   /**
     * @param $startTime, $endTime
     * @return string
     */
    public function update($startTime = null, $endTime = null)
    {
        $options = [];

        $options['start_time'] = $startTime;

        $options['end_time'] = $endTime;

        $response = $this->client->request('PUT','schedules/' . $this->id, ['body' => json_encode($options)]);

        return $response->getBody()->getContents();
    }

   /**
     * @return string
     */
    public function delete()
    {
        $response = $this->client->request('DELETE','schedules/' . $this->id);

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
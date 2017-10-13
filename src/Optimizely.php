<?php

namespace WiderFunnel;

use GuzzleHttp\ClientInterface;
use WiderFunnel\Adapters\AudiencesAdapter;
use WiderFunnel\Adapters\DimensionsAdapter;
use WiderFunnel\Adapters\ExperimentsAdapter;
use WiderFunnel\Adapters\GoalsAdapter;
use WiderFunnel\Adapters\ProjectsAdapter;
use WiderFunnel\Adapters\SchedulesAdapter;
use WiderFunnel\Adapters\UploadedListsAdapter;
use WiderFunnel\Adapters\VariationsAdapter;
use WiderFunnel\Http\Client;

/**
 * Class Optimizely
 * @package WiderFunnel
 */
class Optimizely
{
    /**
     * Optimizely API endpoint
     */
    const BASE_URI = 'https://www.optimizelyapis.com/experiment/v1/';

    /**
     * @var Client
     */
    protected $client;

    /**
     * Optimizely constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param $token
     * @param bool $oauth
     * @return static
     */
    public static function create($token, $oauth = false)
    {
        $headers = ['Content-Type' => 'application/json', 'Authorization' => "Bearer {$token}"];

        if(!$oauth) {
            $headers['Token'] = $token;
            unset($headers['Authorization']);
        }

        $client = new Client([
            'base_uri' => self::BASE_URI,
            'headers' => $headers
        ]);

        return new static($client);
    }

    /**
     * @param null $projectId
     * @return $this
     */
    public function project($projectId)
    {
        return new ProjectsAdapter($this->client, $projectId);
    }

    /**
     * @return ProjectsAdapter
     */
    public function projects()
    {
        return new ProjectsAdapter($this->client);
    }

    /**
     * @param $experimentId
     * @return ExperimentsAdapter
     */
    public function experiment($experimentId)
    {
        return new ExperimentsAdapter($this->client, $experimentId);
    }

    /**
     * @return ExperimentsAdapter
     */
    public function experiments()
    {
        return new ExperimentsAdapter($this->client);
    }

    /**
     * @param $scheduleId
     * @return SchedulesAdapter
     */
    public function schedule($scheduleId)
    {
        return new SchedulesAdapter($this->client, $scheduleId);
    }

    /**
     * @return string
     */
    public function schedules()
    {
        return new SchedulesAdapter($this->client);
    }

    /**
     * @param $variationId
     * @return VariationsAdapter
     */
    public function variation($variationId)
    {
        return new VariationsAdapter($this->client, $variationId);
    }

    /**
     * @return string
     */
    public function variations()
    {
        return new VariationsAdapter($this->client);
    }

    /**
     * @param $goalId
     * @return GoalsAdapter
     */
    public function goal($goalId)
    {
        return new GoalsAdapter($this->client, $goalId);
    }

    /**
     * @return string
     */
    public function goals()
    {
        return new GoalsAdapter($this->client);
    }

    /**
     * @param $audienceId
     * @return AudiencesAdapter
     */
    public function audience($audienceId)
    {
        return new AudiencesAdapter($this->client, $audienceId);
    }

    /**
     * @return string
     */
    public function audiences()
    {
        return new AudiencesAdapter($this->client);
    }

    /**
     * @param $uploadedListId
     * @return UploadedListsAdapter
     */
    public function uploadedList($uploadedListId)
    {
        return new UploadedListsAdapter($this->client, $uploadedListId);
    }

    /**
     * @return string
     */
    public function uploadedLists()
    {
        return new UploadedListsAdapter($this->client);
    }

    /**
     * @param $dimensionId
     * @return DimensionsAdapter
     */
    public function dimension($dimensionId)
    {
        return new DimensionsAdapter($this->client, $dimensionId);
    }

    /**
     * @return string
     */
    public function dimensions()
    {
        return new DimensionsAdapter($this->client);
    }
}
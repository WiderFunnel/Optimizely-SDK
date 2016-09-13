<?php

namespace Optimizely\Adapters;

use Optimizely\Collections\ResultCollection;
use Optimizely\Collections\ScheduleCollection;
use Optimizely\Collections\VariationCollection;
use Optimizely\Items\Experiment;
use Optimizely\Items\Schedule;
use Optimizely\Items\Variation;

/**
 * Class ExperimentsAdapter
 * @package Optimizely
 */
class ExperimentsAdapter extends AdapterAbstract
{
    /**
     * @param $experimentId
     * @return static
     */
    public function find($experimentId)
    {
        $this->setResourceId($experimentId);

        $response = $this->client->get("experiments/{$this->getResourceId()}");

        return Experiment::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return ExperimentsAdapter
     */
    public function pause()
    {
        return $this->update([
            'status' => Experiment::STATUS_PAUSED
        ]);
    }

    /**
     * @param array $attributes
     * @return static
     */
    public function update(array $attributes)
    {
        $response = $this->client->put("experiments/{$this->getResourceId()}", $attributes);

        return Experiment::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return ExperimentsAdapter
     */
    public function resume()
    {
        return $this->launch();
    }

    /**
     * @return ExperimentsAdapter
     */
    public function launch()
    {
        return $this->update([
            'status' => Experiment::STATUS_LIVE
        ]);
    }

    /**
     * @return ExperimentsAdapter
     */
    public function archive()
    {
        return $this->update([
            'status' => Experiment::STATUS_ARCHIVED
        ]);
    }

    /**
     * @return static
     */
    public function delete()
    {
        $response = $this->client->delete("experiments/{$this->getResourceId()}");

        return $this->booleanResponse($response);
    }

    /**
     * @param $start_time
     * @return ExperimentsAdapter
     */
    public function startAt($start_time)
    {
        return $this->schedule($start_time);
    }

    /**
     * @param null $start_time
     * @param null $stop_time
     * @return static
     */
    public function schedule($start_time = null, $stop_time = null)
    {
        $start_time = $this->normalizeDate($start_time);
        $stop_time = $this->normalizeDate($stop_time);

        $attributes = array_filter(
            compact('start_time', 'stop_time')
        );

        $response = $this->client->post("experiments/{$this->getResourceId()}/schedules", $attributes);

        return Schedule::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $stop_time
     * @return ExperimentsAdapter
     */
    public function stopAt($stop_time)
    {
        return $this->schedule(null, $stop_time);
    }

    /**
     * @return mixed
     */
    public function schedules()
    {
        $response = $this->client->get("experiments/{$this->getResourceId()}/schedules");

        return ScheduleCollection::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $description
     * @param array $attributes
     * @return static
     */
    public function createVariation($description, array $attributes = [])
    {
        $attributes = array_merge(compact('description'));

        $response = $this->client->post("experiments/{$this->getResourceId()}/variations", $attributes);

        return Variation::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return mixed
     */
    public function variations()
    {
        $response = $this->client->get("experiments/{$this->getResourceId()}/variations");

        return VariationCollection::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return mixed
     */
    public function results()
    {
        $response = $this->client->get("experiments/{$this->getResourceId()}/stats");

        return ResultCollection::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return mixed
     */
    public function legacyResults()
    {
        $response = $this->client->get("experiments/{$this->getResourceId()}/results");

        return ResultCollection::createFromJson($response->getBody()->getContents());
    }
}